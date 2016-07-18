'use strict';

module.exports = function(grunt) {

    grunt.initConfig({
    	pkg: grunt.file.readJSON('package.json'),

        // Sass
        sass: {
	        options: {
	        	require: 'susy',
	            sourceMap: true,
				outputStyle: 'nested'
	        },
            dev: {
                files: {
                    'styles/styles.css': 'styles/styles.scss'
                }
            }
        },

        // Autoprefixer
        autoprefixer: {
          options: {
            browsers: ['Android >= 2.1', 'Chrome >= 21', 'Explorer >= 8', 'Firefox >= 17', 'Opera >= 12.1', 'Safari >= 6.0']
          },
          dist: {
            options: {
              map: {
                prev: 'styles/'
              }
            },
            src: 'styles/styles.css'
          }
        },

        // Minify CSS
        cssmin: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            combine: {
                files: {
                  'styles/styles.min.css': ['styles/styles.css'],
                },
            },
        },

        //Uglify/Minification for JS files
        uglify: {
            options: {
                banner: '/*! Processed <%= grunt.template.today("dddd, mmmm dS, yyyy, h:MM:ss TT") %> */\n'
            },
            build: {
                src: ['scripts/scripts.js'],
                dest: 'scripts/scripts.min.js'
            }
        },

        // Watch Task
        watch: {

            options: {
                livereload: true,
                nospawn: true
            },

            html: {
                files: ['*.php']
            },

            js: {
                files: ['scripts/*.js'],
                tasks: ['uglify']
            },

            sass: {
                files: ['styles/*.scss'],
                tasks: ['sass','newer:autoprefixer:dist','newer:cssmin'],
            },
        }
    });

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Register Tasks
    grunt.registerTask('default', [
        'sass',
        'newer:autoprefixer:dist',
        'newer:cssmin',
        'uglify',
    ]);

    grunt.registerTask('dev', [
        'watch'
    ]);
};
