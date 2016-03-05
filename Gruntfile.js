/*global module:false*/
module.exports = function (grunt) {

    var default_scss_options = {
        includePaths: require('node-bourbon').includePaths,
        sourceMap: false,
        outputStyle: 'compressed'
    };

    /* on release mode (when making the release) this should be ran with the following command:
     grunt --release
     on local devs, just:
     grunt
     */
    // Project configuration.
    grunt.initConfig({
        // Metadata.
        meta: {
            version: '0.1.0'
        },
        banner: '/*! Thrive Dashboard - ' +
        '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
        '* http://www.thrivethemes.com/\n' +
        '* Copyright (c) <%= grunt.template.today("yyyy") %> ' +
        'Thrive Themes */\n',
        concat: {
            options: {
                separator: ';'
            },
            dist: { // materialize JS files
                src: [

                    'js/materialize/animation.js',
                    'js/materialize/buttons.js',
                    'js/materialize/cards.js',
                    'js/materialize/carousel.js',
                    'js/materialize/character_counter.js',
                    'js/materialize/chips.js',
                    'js/materialize/collapsible.js',
                    'js/materialize/dropdown.js',
                    'js/materialize/forms.js',
                    'js/materialize/global.js',
                    'js/materialize/hammer.min.js',
                    'js/materialize/initial.js',
                    'js/materialize/jquery.easing.1.3.js',
                    'js/materialize/jquery.hammer.js',
                    'js/materialize/leanModal.js',
                    'js/materialize/materialbox.js',
                    'js/materialize/parallax.js',
                    'js/materialize/pushpin.js',
                    'js/materialize/scrollFire.js',
                    'js/materialize/scrollspy.js',
                    'js/materialize/sideNav.js',
                    'js/materialize/slider.js',
                    'js/materialize/tabs.js',
                    'js/materialize/toasts.js',
                    'js/materialize/tooltip.js',
                    'js/materialize/transitions.js',
                    'js/materialize/velocity.min.js',
                    'js/materialize/waves.js',
                    'js/main.js',
                    'js/navigation.js',
                    'js/skip-link-focus-fix.js'
                ],
                dest: 'js/dist/ta-main.js'
            },
            admin: {
                src: [
                    'admin/js/admin-main.js'
                ],
                dest: 'admin/js/dist/admin.js'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                files: {
                    'js/dist/ta-main.min.js': ['js/dist/ta-main.js'],
                    'admin/js/dist/admin.min.js': ['admin/js/dist/admin.js']
                }
            }
        },
        watch: {
            js: {
                files: ['js/materialize/*.js', 'js/main.js', 'admin/js/admin-main.js', 'js/customizer.js', 'js/navigation.js', 'js/skip-link-focus-fix.js'],
                tasks: ['js_compile'],
                options: {
                    spawn: false,
                    interrupt: false
                }
            },
            sass: {
                files: [
                    'css/**/*.scss',
                    'admin/css/**/*.scss'
                ],
                tasks: ['sass:main'],
                options: {
                    interrupt: false,
                    spawn: false,
                    precision: 2
                }
            }
        },
        sass: {
            main: {
                files: {
                    'css/styles.css': 'css/sass/styles.scss',
                    'admin/css/admin.css': 'admin/css/sass/admin.scss',
                    'css/main.css': 'css/sass/main.scss'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('js_compile', ['concat:dist', 'concat:admin', 'uglify:dist']);

    grunt.registerTask('build_all', ['js_compile', 'sass:main']);

    var register_watch_task = grunt.option('nowatch') || grunt.option('release') ? false : true,
        defaultTasks = ['build_all'];

    if (register_watch_task) {
        defaultTasks.push('watch');
    }

    grunt.registerTask('default', defaultTasks);

};