
// Selecting
$('.music-element [data-menu-toggle]').click(function () {
    activate($(this).parents('.music-element').parent());
});

// Deselecting
$($('.deselect-composition')).click(function () {
    if (($('#my-compositions .active').length > 0)) {
        $('.music-element').parent().removeClass('active');
    }
});

// Copy file link action
$('.composition-flink-copier').click(function () {
    const fLink = $('#my-compositions .active').find('.composition-file').text().trim();
    navigator.clipboard.writeText(fLink)
        .then(() => {
            show_toast(3000, "✔️ File link coppied");
        })
        .catch((error) => {
            console.error('Error copying text:', error);
            show_toast('❌ Copy failed. Please try again.');
        });
});

// Copy video link action
$('.composition-vlink-copier').click(function () {
    const vLink = $('#my-compositions .active').find('.composition-video').text().trim();
    if (vLink == "No link provided") {
        alert('This song has no video');
    } else {
        navigator.clipboard.writeText(vLink)
            .then(() => {
                show_toast(3000, "✔️ Video link coppied");
            })
            .catch((error) => {
                console.error('Error copying text:', error);
                show_toast('❌ Copy failed. Please try again.');
            });
    }
});

// Download file action
$('.composition-file-downloader').click(function (e) {
    let fLink;
    if (window.location.href.includes("music.php")) {
        e.preventDefault();
        fLink = $(this).attr('href');
    } else if (window.location.href.includes("admin_cpanel.php")) {
        fLink = $('#my-compositions .active').find('.composition-file').text().trim();
    }
    const fID = get_gDrive_file_id(fLink),
        downloadLink = 'https://drive.google.com/uc?export=download&id=' + fID;
    window.open(downloadLink, '_blank');
});

// Remove composition audio action
$('#removeCompositionAudio').click(function () {
    var songName,
        notProvided,
        notProvidedIndicator;
    $.each($('.music-element'), function () {
        const dis = $(this);
        if (dis.parent().hasClass('active')) {
            notProvided = dis.find('.composition-audio');
            notProvidedIndicator = dis.find('.composition-audio').prev();
            songName = dis.find('.composition-title > span').text().trim();
        }
    });
    if (songName) {
        // Send an AJAX request to the PHP file
        addLoader();
        $.ajax({
            url: 'remove_composition_audio.php',
            type: 'POST',
            dataType: 'json',
            data: { songName: songName },
            success: function (response) {
                removeLoader();
                if (response.success) {
                    show_toast(7000, response.message);
                    notProvided.text('No audio provided').addClass('text-danger');
                    notProvidedIndicator.append('<span class="fa fa-close ms-3"></span>');

                    const songEditor = $('.song-editor');
                    songEditor.find('.add-audio-file').collapse('show');
                    songEditor.find('.change-audio-file').collapse('hide');
                } else {
                    show_toast(15000, 'Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ' + error);
                show_toast(5000, 'AJAX Error: ' + error);
                removeLoader();
            }
        });
    } else {
        alert('Error: No song name provided.');
    }
});

// Remove composition action
$('.composition-cont-menu .composition-removal').click(function () {
    // Write name of selected
    const songName = $('#my-compositions .active').find('.composition-title > span').text().trim();
    $('.selected-composition-name').html(songName);
    visible($('.composition-iframe-viewer')) && close_preview(); // Hide preview
});

$('#removeCompositionBtn').click(function () {
    var songName = $('.composition-removal-dialog .selected-composition-name').text().trim();
    // Send an AJAX request to the PHP file
    addLoader();
    $.ajax({
        url: 'remove_composition.php',
        type: 'POST',
        dataType: 'json',
        data: { songName: songName },
        success: function (response) {
            // Handle the response
            if (response.success) {
                // removeLoader();
                show_toast(7000, response.message);
                setTimeout(() => {
                    window.location.reload();
                }, 7000);
            } else {
                // Handle errors
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX errors
            console.error(xhr.responseText);
        }
    });
});

// Edit action
$('.composition-data-editor').click(function () {
    visible($('.composition-iframe-viewer')) && close_preview(); // Hide preview
    // Get details of selected
    const songEditor = $('.song-editor'),
        activeSong = $('#my-compositions .active'),
        songName = activeSong.find('.composition-title > span').text().trim(),
        dayComposed = activeSong.find('.composed-day').text().trim();
    let monthComposed = activeSong.find('.composed-month').text().trim();
    const yearComposed = activeSong.find('.composed-year').text().trim(),
        songAbout = activeSong.find('.composition-about').text().trim();
    fileLink = activeSong.find('.composition-file').text().trim();
    let audioDirectory = activeSong.find('.composition-audio').text().trim(),
        videoLink = activeSong.find('.composition-video').text().trim();
    audioDirectory == "No audio provided" ? audioDirectory = "" : audioDirectory;
    videoLink == "No link provided" ? videoLink = "" : videoLink;

    // Write details of selected
    songEditor.find('.selected-composition-name').html(songName);
    songEditor.find('[name="current_song_name"]').val(songName);
    songEditor.find('[name="song_name"]').val(songName);
    songEditor.find('[name="song_date_year"]').val(yearComposed);
    songEditor.find('[name="song_about"]').val(songAbout);
    songEditor.find('[name="song_date_month"]').val(month_nm_to_num(monthComposed));
    songEditor.find('[name="song_date_day"]').val(dayComposed);
    songEditor.find('[name="song_file_link"]').val(fileLink);
    // songEditor.find('[name="song_audio"]').val(audioDirectory);

    if (audioDirectory == "") {
        songEditor.find('.add-audio-file').collapse('show');
        songEditor.find('.change-audio-file').collapse('hide');
    } else {
        songEditor.find('.add-audio-file').collapse('hide');
        songEditor.find('.change-audio-file').collapse('show');
    }

    songEditor.find('[name="song_video_link"]').val(videoLink);
});


// Search action (user)
function reset_filter_user() {
    const songElement = $('.song-element');
    songElement.parent().find('.song-not-found').remove();
    songElement.show();
}
$('#songSearcher').on({
    keyup: function () {
        const $input = $(this);
        const schStr = $input.val().toLowerCase();
        const $songElements = $('.song-element');
        const $parentContainer = $songElements.parent();
        const $matchingElements = $songElements.filter(function () {
            const corresSong = $(this).find('.song-title').text().toLowerCase();
            return corresSong.includes(schStr);
        });
        jump_page_to($('#allCompositionsList'), 170);
        if ($matchingElements.length === 0) {
            // No matches, append "Song not found"
            $songElements.hide(); // Hide all
            if ($parentContainer.find('.song-not-found').length === 0) {
                $parentContainer.append('<div class="display-4 text-center song-not-found">Song not found</div>');
            }
        } else {
            // Remove "Song not found"
            $parentContainer.find('.song-not-found').remove();
            // Toggle visibility
            $songElements.each(function () {
                const corresSong = $(this).find('.song-title').text().toLowerCase();
                const $element = $(this);
                if (corresSong.includes(schStr)) {
                    $element.show();
                } else {
                    $element.hide();
                }
            });
        }
    },
    // focus: function () {
    //     // if ($(this).val().trim() !== '') {
    //         reset_filter_user();
    //     // }
    // }
});

// Search action (Admin)
function reset_filter_admin() {
    $('.music-element').parent().show()
}
$('#my-compositions .search-box__input').on({
    keyup: function () {
        const schStr = $(this).val().toLowerCase(),
            $musicElements = $('.music-element'),
            $parentContainer = $musicElements.parent().parent(),
            $matchingElements = $musicElements.filter(function () {
                const corresSong = $(this).find('.composition-title').text().toLowerCase();
                return corresSong.includes(schStr);
            });
        jump_page_to($('.composition-years'), 70);
        if ($matchingElements.length === 0) {
            // No matches, append "Song not found"
            if ($parentContainer.find('.song-not-found').length === 0) {
                $parentContainer.append('<div class="display-4 text-center song-not-found">Song not found</div>');
            }
            $musicElements.parent().hide(); // Hide all
        } else {
            // Remove "Song not found"
            $parentContainer.find('.song-not-found').remove();
            // Toggle visibility
            $musicElements.each(function () {
                const corresSong = $(this).find('.composition-title').text().toLowerCase();
                if (corresSong.includes(schStr)) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }
    }
});

// Filter action (User)
window.addEventListener('load', function () {
    if (window.location.href.includes("music.php")) {
        var offcanvas = document.getElementById('compositionFilter');
        var offcanvasLiItems = offcanvas.querySelectorAll('li');

        offcanvasLiItems.forEach(function (li) {
            li.addEventListener('click', function () {
                var searchText = li.textContent.trim().toLowerCase();
                var compositionElements = document.querySelectorAll('.song-element');

                jump_page_to($('#allCompositionsList'), 170);
                compositionElements.forEach(function (composition) {
                    // Filter by year of composition
                    if (li.parentElement.classList.contains('composition-years')) {
                        var dateComposedText = composition.querySelector('.date-composed').textContent.trim().toLowerCase();
                        if (dateComposedText.includes(searchText)) {
                            composition.style.display = 'block';
                        } else {
                            composition.style.display = 'none';
                        }
                    }
                    // Filter by composition category
                    // if (li.parentElement.classList.contains('composition-category')) {
                    //     // code
                    // }
                    // Filter by media type
                    if (li.parentElement.classList.contains('composition-media-type')) {
                        const mediaType = li.textContent.trim().toLocaleLowerCase();
                        // console.log(mediaType);
                        switch (mediaType) {
                            case 'audio':
                                $.each($('.song-element'), function () {
                                    const dis = $(this);
                                    if (dis.find('audio').length < 1) {
                                        dis.hide();
                                    }
                                });
                                break;
                            case 'video':
                                $.each($('.song-element'), function () {
                                    const dis = $(this);
                                    if (dis.find('.watch-composition-video-link').length < 1) {
                                        dis.hide();
                                    }
                                });
                                break;
                            default:
                                show_toast(3000, '❌ Media type not found');
                                break;
                        }
                    }
                });
                var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvas);
                offcanvasInstance.hide();
            });
        });
    }
});

// Filter action (Admin)
window.addEventListener('load', function () {
    if (window.location.href.includes("admin_cpanel.php")) {
        var compositionFilterAdmin = $('#compositionFilterAdmin'),
            yearElems = compositionFilterAdmin.find('li:not(.show-all)');
        yearElems.click(function () {
            var searchText = $(this).text().trim().toLowerCase();
            $('.music-element').each(function () {
                var composition = $(this);
                var dateComposedText = composition.find('.composed-year').text().trim().toLowerCase();
                if (dateComposedText.includes(searchText)) {
                    composition.parent().show();
                } else {
                    composition.parent().hide();
                }
            });
        });
    }
});

// Refresh / unfilter compositions
$(document).on({
    keydown: function (e) {
        /*  Alt R for Song Refresh */
        if (e.altKey && (e.keyCode == 82)) {
            if (window.location.href.includes("music.php")) {
                reset_filter_user();
            } else if (window.location.href.includes("admin_cpanel.php")) {
                $('.composition-years > .show-all').trigger('click');
            }
            show_toast(3000, "Songs refreshed");
        }
    }
});

// Preview composition

function preview_selected_song() {
    preview_file($('.composition-iframe-viewer'));
}
$('.composition-file-previewer').click(preview_selected_song);

// Preview composition to add

function preview_dynamic_file(previewSpace) {
    let toShow = previewSpace,
        thePreview = toShow.find('iframe'),
        songLinkID = get_gDrive_file_id($('#newSongUploader #sFileLink').val()),
        previewLink = 'https://drive.google.com/file/d/' + songLinkID + '/preview';
    if (thePreview.attr('src') != previewLink) {
        thePreview.html('');
        thePreview.attr('src', '');
        thePreview.attr('src', previewLink);
    }
    hidden(toShow) && toShow.show();
}

function isValidGoogleDriveLink(link) {
    const minLength = 50; // minimum link length
    return link.trim().length >= minLength &&
        link.includes("drive.google.com") &&
        link.includes("file/d/") &&
        (link.includes("view") || link.includes("usp=drive_link"));
}

// Preview action
$('#newSongUploader #sFileLink').on('paste input', function (e) {
    var inputField = $(this);
    if (visible($('#directFilePreview'))) {
        // setTimeout to update the input field
        setTimeout(() => {
            var inputData = inputField.val();
            if (isValidGoogleDriveLink(inputData)) {
                preview_dynamic_file($('#directFilePreview'));
            } else {
                show_toast(3000, 'Invalid g-drive shared link');
            }
        }, 100);
    }
});

/**
 * Play audio songs
 */

$("#allCompositionsList audio").on('play', function () {
    $('.song-element').removeClass('audio-playing');
    $(this).parents('.song-element').addClass('audio-playing');
    // Pause sibling audios
    $('.song-element:not(.audio-playing)').find('audio')[0].pause();
    // Pause media player audio
    esgSongAudioElement[0].pause();
    musicPlayerButton.removeClass('fa-pause').addClass('fa-play');
});

// Music player (User)
const currentVideoHolder = $('.current-video__video'),
    esgSongAudioElement = $('#pageAudioPlayer'),
    musicPlayerButton = $('.music-controlls__player');

const songsWithAudios = $('.song-element').filter(function () {
    return $(this).find('audio').length > 0;
});
const numSongsWithAudios = songsWithAudios.length,
    songsWithAudiosNames = songsWithAudios.map(function () {
        return $(this).find('.song-title').text();
    }).get(),
    audioPlaylistLinks = songsWithAudios.map(function () {
        return $(this).find('audio source').attr('src');
    }).get();

function remove_dir_and_ext(text) {
    return text = text.slice(
        text.lastIndexOf('/') + 1, text.lastIndexOf('.')
    );
}
// Play actions
function toggle_current_audio_state() {
    var audio = esgSongAudioElement[0],
        playingName = esgSongAudioElement.attr('src'),
        playingName = remove_dir_and_ext(playingName);
    // Activate current song in the list
    let toActivate = $('.audio-songs-list__body').find('div:icontains(' + playingName + ')');
    activate(toActivate.parents('[title]'));
    // Play / pause current audio
    setTimeout(() => {
        if (audio.paused) {
            stop_all_audios();
            audio.play();
            musicPlayerButton.removeClass('fa-play').addClass('fa-pause');
        } else {
            audio.pause();
            musicPlayerButton.removeClass('fa-pause').addClass('fa-play');
        }
    }, 1);
}

function play_this_song(desiredSong) {
    stop_all_audios();
    esgSongAudioElement.attr('src', desiredSong[0]);
    $('.current-music-player .music-name').html(desiredSong[1]);
    musicPlayerButton.removeClass('fa-play').addClass('fa-pause');
    esgSongAudioElement[0].play();
}

function play_another_song(direction) {
    var currentPlaying = esgSongAudioElement.attr('src'),
        anotherSongIndex,
        anotherSongAudioName,
        anotherSongSongName;
    audioPlaylistLinks.forEach((song, index) => {
        if (song == currentPlaying) {
            if (direction == 'next') {
                anotherSongIndex = (index + 1) % audioPlaylistLinks.length;
            }
            if (direction == 'previous') {
                anotherSongIndex = ((index - 1) + audioPlaylistLinks.length) % audioPlaylistLinks.length;
            }
        }
        if (!(audioPlaylistLinks[anotherSongIndex] == undefined)) {
            anotherSongAudioName = audioPlaylistLinks[anotherSongIndex],
                anotherSongSongName = remove_dir_and_ext(anotherSongAudioName);
            let toActivate = $('.audio-songs-list__body').find('div:icontains(' + anotherSongSongName + ')');
            play_this_song([anotherSongAudioName, anotherSongSongName]);
            activate(toActivate.parents('[title]'));
        }
    });
}

// Stop any audio playing
function stop_all_audios() {
    esgSongAudioElement[0].pause();
    musicPlayerButton.removeClass('fa-pause').addClass('fa-play');
    let audios = document.querySelectorAll('audio');
    Array.from(audios).forEach(aud => {
        if (!aud.paused) {
            aud.pause();
        }
    });
}

// Display audio details
window.addEventListener('load', function () {
    // Write number of audio songs and set the first one on player
    $('.audio-songs-list__header_counter').html(numSongsWithAudios);
    // Display audio songs names
    if (audioPlaylistLinks.length > 0) {
        const audioPlaylistNames = audioPlaylistLinks.map(function (el) {
            return remove_dir_and_ext(el);
        });
        $('.current-music-player__music-info .music-name').html(audioPlaylistNames[0]);
        $('#pageAudioPlayer').attr('src', audioPlaylistLinks[0]);
        $.each(audioPlaylistNames, function (index, songName) {
            const songDiv = `
                <div title="${songName}" class="py-2 list-item">
                    <div class="ptr clickDown list-item_text">
                        ${songName}
                    </div>
                </div>
            `;
            $('.audio-songs-list__body').append(songDiv);
        });
    } else {
        const songDiv = `
        <div class="alert d-sm-flex gap-3">
                <span class="fa fa-search mb-4"></span>
                <p class="m-0">
                    No audio songs found at this time.<br><br>
                    <button class="btn btn-sm btn-secondary" onclick="window.location.reload()" class="btn"><span class="fa fa-refresh"></span> Retry</button>
                </p>
            </div>
        `;
        $('.audio-songs-list__body').append(songDiv);
    }

    // Play from playlist
    $('.audio-songs-list__body .list-item_text').click(function () {
        let songName = $(this).text().trim(),
            corresAudio = audioPlaylistLinks.filter(function (el) {
                return el.includes(songName);
            });
        const currentPlayingDir = esgSongAudioElement.attr('src');
        activate($(this).parent());
        if (corresAudio != currentPlayingDir) {
            play_this_song([corresAudio, songName]);
        } else if (corresAudio == currentPlayingDir) {
            var audio = esgSongAudioElement[0];
            if (audio.paused) {
                stop_all_audios();
                audio.play();
                musicPlayerButton.removeClass('fa-play').addClass('fa-pause');
            } else {
                show_toast(3000, "✔️ The song is playing");
            }
        }
    });

    // Loop the playlist
    setInterval(() => {
        esgSongAudioElement.on({
            timeupdate: function () {
                let dis = this,
                    elapsedTime = dis.currentTime,
                    durationTime = dis.duration;
                if (elapsedTime == durationTime) {
                    play_another_song('next');
                }
            }
        });
    }, 1000);
});

// Statistics (Admin)
// Function to get song names based on a condition
function getSongNames(conditionCallback) {
    return $('.music-element').map(function () {
        let dis = $(this),
            songName = dis.find('.composition-title > span').text().trim();
        if (conditionCallback(dis)) {
            return songName;
        }
    }).get();
}

// Function to update the stats display
function updateStatsDisplay(title, songNames) {
    const allLen = songNames.length;
    $('.stats-body .stats-title').html(title);
    $('.stats-body .stats-counter').html(allLen);
    $('.stats-body .my-list').html('');
    $.each(songNames, function (inx, songName) {
        const songListItem = `<li title="${songName}" class="py-2 list-item">${songName}</li>`;
        $('.stats-body .my-list').append(songListItem);
    });
}

// Event handler for button clicks
$('.stats-icons button').click(function () {
    let conditionCallback, title;
    if ($(this).hasClass('show-all-list')) {
        conditionCallback = () => true;
        title = 'All songs';
    } else if ($(this).hasClass('show-audio-list')) {
        conditionCallback = dis => dis.find('.composition-audio').text().trim().toLowerCase() !== 'no audio provided';
        title = 'Audio songs';
    } else if ($(this).hasClass('show-video-list')) {
        conditionCallback = dis => dis.find('.composition-video').text().trim().toLowerCase() !== 'no link provided';
        title = 'Video songs';
    } else if ($(this).hasClass('show-new-list')) {
        const currentYear = new Date().getFullYear();
        conditionCallback = dis => parseInt(dis.find('.composed-year').text().trim()) === currentYear;
        title = 'New songs';
    }

    const songNames = getSongNames(conditionCallback);
    updateStatsDisplay(title, songNames);
});

// Jump to clicked song
$('.stats-body .my-list').on('click', 'li', function () {
    const songName = $(this).text().trim();
    let matches = 0;
    $.each($('.music-element'), function () {
        const dis = $(this);
        const disName = dis.find('.composition-title > span').text().trim();
        if (disName.includes(songName)) {
            matches++;
            jump_page_to(dis, 170);
        }
    });
    // Hide the offcanvas if a match was found
    if (matches > 0) {
        var offcanvas = $('#shortStatistics');
        var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvas);
        offcanvasInstance.hide();
    }
    matches = 0;
});
