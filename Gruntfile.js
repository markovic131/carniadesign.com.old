module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        options : {

            base : 'src',

            publish : 'public/builds',

            clean : {
                all : [
                    '<%= options.css.concat %>',
                    '<%= options.css.min %>',
                    '<%= options.js.min %>',
                    '<%= options.js.concat %>',
                ],
                concat: [
                    '<%= options.css.concat %>',
                    '<%= options.js.concat %>'
                ]
            },

            css : {
                base : '<%= options.base %>/css',
                files : [
                    '<%= options.css.base %>/less.css'
                ],
                concat : '<%= options.css.base %>/concat.css',
                min : '<%= options.publish %>/css/style.min.css'
            },

            js : {
                base : '<%= options.base %>/js',
                files : [
                    '<%= options.js.base %>/jquery.js'
                ],
                concat : '<%= options.js.base %>/concat.js',
                min : '<%= options.publish %>/js/app.min.js'
            },

            less: {
                base: '<%= options.base %>/less',
                file: '<%= options.less.base %>/main.less',
                compiled: '<%= options.css.base %>/less.css'
            },

        },

        clean: {
            all: {
                src: '<%= options.clean.all %>'
            },
            concat: {
                src: '<%= options.clean.concat %>'
            }
        },

        jshint: {
            all: ['Gruntfile.js']
        },

        concat: {
            css : {
                files: {
                    '<%= options.css.concat %>' : '<%= options.css.files %>'
                }
            },
            js : {
                options: {
                    block: true,
                    line: true,
                    stripBanners: true
                },
                files: {
                    '<%= options.js.concat %>' : '<%= options.js.files %>',
                }
            }
        },

        less: {
            main: {
                options: {
                    yuicompress: true,
                    ieCompat: true
                },
                files: {
                    '<%= options.less.compiled %>': '<%= options.less.file %>'
                }
            }
        },

        uglify: {
            options: {
                mangle : false,
                //beautify: true,
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n'
            },
            build: {
                src: '<%= options.js.concat %>',
                dest: '<%= options.js.min %>'
            }
        },

        cssmin: {
            minify: {
                src: '<%= options.css.concat %>',
                dest: '<%= options.css.min %>'
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-less');

    // Default task(s).
    grunt.registerTask('default', ['clean:all','less','jshint:all','concat','cssmin','uglify','clean:concat']);

    // Production
    // grunt.registerTask('default', ['clean:all','concat','cssmin','uglify','clean:concat']);

};