// Sidebar

! function($) {
    "use strict";
    var Sidemenu = function() {
        this.$menuItem = $("#sidebar-menu a");
    };

	Sidemenu.prototype.init = function() {
		var $this = this;
		$this.$menuItem.on('click', function(e) {
		if ($(this).parent().hasClass("submenu")) {
			e.preventDefault();
		}
		if (!$(this).hasClass("subdrop")) {
			$("ul", $(this).parents("ul:first")).slideUp(350);
			$("a", $(this).parents("ul:first")).removeClass("subdrop");
			$(this).next("ul").slideDown(350);
			$(this).addClass("subdrop");
		} else if ($(this).hasClass("subdrop")) {
			$(this).removeClass("subdrop");
			$(this).next("ul").slideUp(350);
		}
	});
		$("#sidebar-menu ul li.submenu a.active").parents("li:last").children("a:first").addClass("active").trigger("click");
	},
	$.Sidemenu = new Sidemenu;

}(window.jQuery),


$(document).ready(function($) {
	
	// Sidebar Initiate
	
	$.Sidemenu.init();

    // Sidebar overlay
	
    var $sidebarOverlay = $(".sidebar-overlay");
    $("#mobile_btn, .task-chat").on("click", function(e) {
        var $target = $($(this).attr("href"));
        if ($target.length) {
            $target.toggleClass("opened");
            $sidebarOverlay.toggleClass("opened");
            $("html").toggleClass("menu-opened");
            $sidebarOverlay.attr("data-reff", $(this).attr("href"));
        }
        e.preventDefault();
    });

    $sidebarOverlay.on("click", function(e) {
        var $target = $($(this).attr("data-reff"));
        if ($target.length) {
            $target.removeClass("opened");
            $("html").removeClass("menu-opened");
            $(this).removeClass("opened");
            $(".main-wrapper").removeClass("slide-nav");
        }
        e.preventDefault();
    });
	
    // Select 2

    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }

    // Modal

    if ($('.modal').length > 0) {
        var modalUniqueClass = ".modal";
        $('.modal').on('show.bs.modal', function(e) {
            var $element = $(this);
            var $uniques = $(modalUniqueClass + ':visible').not($(this));
            if ($uniques.length) {
                $uniques.modal('hide');
                $uniques.one('hidden.bs.modal', function(e) {
                    $element.modal('show');
					$("body").addClass("modal-open");
                });
                return false;
            }
        });
    }

    // Floating Label

    if ($('.floating').length > 0) {
        $('.floating').on('focus blur', function(e) {
            $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    }

    // Right Sidebar Scroll

    if ($('.msg-list-scroll').length > 0) {
        $('.msg-list-scroll').slimscroll({
            height: '100%',
            color: '#878787',
            disableFadeOut: true,
            borderRadius: 0,
            size: '4px',
            alwaysVisible: false,
            touchScrollStep: 100
        });
        var h = $(window).height() - 124;
        $('.msg-list-scroll').height(h);
        $('.msg-sidebar .slimScrollDiv').height(h);

        $(window).resize(function() {
            var h = $(window).height() - 124;
            $('.msg-list-scroll').height(h);
            $('.msg-sidebar .slimScrollDiv').height(h);
        });
    }

    // Left Sidebar Scroll

    if ($('.slimscroll').length > 0) {
        $('.slimscroll').slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: "7px",
            color: '#ccc',
            wheelStep: 10,
            touchScrollStep: 100
        });
        var hei = $(window).height() - 60;
        $('.slimscroll').height(hei);
        $('.sidebar .slimScrollDiv').height(hei);

        $(window).resize(function() {
            var hei = $(window).height() - 60;
            $('.slimscroll').height(hei);
            $('.sidebar .slimScrollDiv').height(hei);
        });
    }

    // Page wrapper height

    if ($('.page-wrapper').length > 0) {
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }

    $(window).resize(function() {
        if ($('.page-wrapper').length > 0) {
            var height = $(window).height();
            $(".page-wrapper").css("min-height", height);
        }
    });

    // Datetimepicker

    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    }

    // Datatable

    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            "bFilter": false,
        });
    }

    // Bootstrap Tooltip

    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Toggle Button

    if ($('.btn-toggle').length > 0) {
        $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-success').size() > 0) {
                $(this).find('.btn').toggleClass('btn-success');
            }
        });
    }

    // Mobile Menu

    if ($('.main-wrapper').length > 0) {
        var $wrapper = $(".main-wrapper");
        $('#mobile_btn').click(function() {
            $wrapper.toggleClass('slide-nav');
            $('#chat_sidebar').removeClass('opened');
            $(".dropdown.open > .dropdown-toggle").dropdown("toggle");
            return false;
        });
        $('#open_msg_box').click(function() {
            $wrapper.toggleClass('open-msg-box');
            $('.themes').removeClass('active');
            $('.dropdown').removeClass('open');
            return false;
        });
    }

    // Product thumb images

    if ($('.proimage-thumb li a').length > 0) {
        var full_image = $(this).attr("href");
        $(".proimage-thumb li a").click(function() {
            full_image = $(this).attr("href");
            $(".pro-image img").attr("src", full_image);
            return false;
        });
    }

    // Lightgallery

    if ($('#pro_popup').length > 0) {
        $('#pro_popup').lightGallery({
            thumbnail: true,
            selector: 'a'
        });
    }
	
    if ($('#lightgallery').length > 0) {
        $('#lightgallery').lightGallery({
			thumbnail: true,
			selector: 'a'
		});
    }
	
	// Incoming call popup
	
    if ($('#incoming_call').length > 0) {
		$(window).on('load',function(){
			$('#incoming_call').modal('show');
			$("body").addClass("call-modal");
		});
    }

    // Summernote

    if ($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: false
        });
    }

    // Will Delete

    if ($('.themes-icon').length > 0) {
        $(".themes-icon").click(function() {
            $('.themes').toggleClass("active");
            if ($('.main-wrapper').hasClass('open-msg-box')) {
                $('.main-wrapper').removeClass('open-msg-box');
            }
        });
    }

    // Check all email

    if ($('.checkbox-all').length > 0) {
        $('.checkbox-all').click(function() {
            $('.checkmail').click();
        });
    }
    if ($('.checkmail').length > 0) {
        $('.checkmail').each(function() {
            $(this).click(function() {
                if ($(this).closest('tr').hasClass("checked")) {
                    $(this).closest('tr').removeClass('checked');
                } else {
                    $(this).closest('tr').addClass('checked');
                }
            });
        });
    }

    // Mail important

    if ($('.mail-important').length > 0) {
        $(".mail-important").click(function() {
            $(this).find('i.fa').toggleClass("fa-star");
            $(this).find('i.fa').toggleClass("fa-star-o");
        });
    }

    if ($('.dropdown-toggle').length > 0) {
        $('.dropdown-toggle').click(function() {
            if ($('.main-wrapper').hasClass('open-msg-box')) {
                $('.main-wrapper').removeClass('open-msg-box');
            }
        });
    }
	
	/* Custom Modal */
	
	if ($('.custom-modal').length > 0) {
		$(".custom-modal .modal-content").prepend('<button data-dismiss="modal" class="close" type="button">×</button>');
	}

    // Custom Backdrop for modal popup

    $('a[data-toggle="modal"]').on('click', function() {
        setTimeout(function() {
            if ($(".modal.custom-modal").hasClass('show')) {
                $(".modal-backdrop").addClass('custom-backdrop');

            }
        }, 500);
    });

    // Task function

    var notificationTimeout;

   

    // Adds a new Task to the todo list 
    var addTask = function() {
        // Get the new task entered by user
        var newTask = $('#new-task').val();
        // If new task is blank show error message
        if (newTask === '') {
            $('#new-task').addClass('error');
            $('.new-task-wrapper .error-message').removeClass('hidden');
        } else {
            var todoListScrollHeight = $('.task-list-body').prop('scrollHeight');
            // Make a new task template
            var newTemplate = $(taskTemplate).clone();
            // update the task label in the new template
            newTemplate.find('.task-label').text(newTask);
            // Add new class to the template
            newTemplate.addClass('new');
            // Remove complete class in the new Template in case it is present
            newTemplate.removeClass('completed');
            //Append the new template to todo list
            $('#task-list').append(newTemplate);
            // Clear the text in textarea
            $('#new-task').val('');
            // As a new task is added, hide the mark all tasks as incomplete button & show the mark all finished button
            $('#mark-all-finished').removeClass('move-up');
            $('#mark-all-incomplete').addClass('move-down');
            // Show notification
            updateNotification(newTask, 'added to list');
            // Smoothly scroll the todo list to the end
            $('.task-list-body').animate({
                scrollTop: todoListScrollHeight
            }, 1000);
        }
    };

    var closeNewTaskPanel = function() {
        $('.add-task-btn').toggleClass('visible');
        $('.new-task-wrapper').toggleClass('visible');
        if ($('#new-task').hasClass('error')) {
            $('#new-task').removeClass('error');
            $('.new-task-wrapper .error-message').addClass('hidden');
        }
    };

    
    var taskTemplate = '<li class="task"><div class="task-container"><span class="task-action-btn task-check"><span class="action-circle large complete-btn" title="Mark Complete"><i class="material-icons">check</i></span></span><span class="task-label" contenteditable="true"></span><span class="task-action-btn task-btn-right"><span class="action-circle large" title="Assign"><i class="material-icons">person_add</i></span> <span class="action-circle large delete-btn" title="Delete Task"><i class="material-icons">delete</i></span></span></div></li>';
    // Shows panel for entering new tasks
    $('.add-task-btn').click(function() {
        var newTaskWrapperOffset = $('.new-task-wrapper').offset().top;
        $(this).toggleClass('visible');
        $('.new-task-wrapper').toggleClass('visible');
        // Focus on the text area for typing in new task
        $('#new-task').focus();
        // Smoothly scroll to the text area to bring the text are in view
        $('body').animate({
            scrollTop: newTaskWrapperOffset
        }, 1000);
    });

    // Deletes task on click of delete button
    $('#task-list').on('click', '.task-action-btn .delete-btn', function() {
        var task = $(this).closest('.task');
        var taskText = task.find('.task-label').text();
        task.remove();
        updateNotification(taskText, ' has been deleted.');
    });

    // Marks a task as complete
    $('#task-list').on('click', '.task-action-btn .complete-btn', function() {
        var task = $(this).closest('.task');
        var taskText = task.find('.task-label').text();
        var newTitle = task.hasClass('completed') ? 'Mark Complete' : 'Mark Incomplete';
        $(this).attr('title', newTitle);
        task.hasClass('completed') ? updateNotification(taskText, 'marked as Incomplete.') : updateNotification(taskText, ' marked as complete.', 'success');
        task.toggleClass('completed');
    });


    $('#new-task').keydown(function(event) {
        // Get the code of the key that is pressed
        var keyCode = event.keyCode;
        var enterKeyCode = 13;
        var escapeKeyCode = 27;
        // If error message is already displayed, hide it.
        if ($('#new-task').hasClass('error')) {
            $('#new-task').removeClass('error');
            $('.new-task-wrapper .error-message').addClass('hidden');
        }
        // If key code is that of Enter Key then call addTask Function
        if (keyCode == enterKeyCode) {
            event.preventDefault();
            addTask();
        }
        
        else if (keyCode == escapeKeyCode)
            closeNewTaskPanel();

    });

    // Add new task on click of add task button
    $('#add-task').click(addTask);

    // Close new task panel on click of close panel button
    $('#close-task-panel').click(closeNewTaskPanel);


    $('#mark-all-finished').click(function() {
        $('#task-list .task').addClass('completed');
        $('#mark-all-incomplete').removeClass('move-down');
        $(this).addClass('move-up');
        updateNotification('All tasks', 'marked as complete.', 'success');
    });

    
    $('#mark-all-incomplete').click(function() {
        $('#task-list .task').removeClass('completed');
        $(this).addClass('move-down');
        $('#mark-all-finished').removeClass('move-up');
        updateNotification('All tasks', 'marked as Incomplete.');
    });

    // Dropfiles

    if ($("#drop-zone").length > 0) {
        var dropZone = document.getElementById('drop-zone');
        var uploadForm = document.getElementById('js-upload-form');
        var startUpload = function(files) {
            console.log(files)
        }

        uploadForm.addEventListener('submit', function(e) {
            var uploadFiles = document.getElementById('js-upload-files').files;
            e.preventDefault()

            startUpload(uploadFiles)
        })

        dropZone.ondrop = function(e) {
            e.preventDefault();
            this.className = 'upload-drop-zone';

            startUpload(e.dataTransfer.files)
        }

        dropZone.ondragover = function() {
            this.className = 'upload-drop-zone drop';
            return false;
        }

        dropZone.ondragleave = function() {
            this.className = 'upload-drop-zone';
            return false;
        }

    }
	
    // Coming Soon

    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            var t = getTimeRemaining(endtime);

            daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }

    var deadline = new Date(Date.parse(new Date()) + 256 * 24 * 60 * 60 * 1000);
    if ($("#countdown").length > 0)
        initializeClock('countdown', deadline);


});