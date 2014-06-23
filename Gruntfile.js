// Generated on 2014-03-14 using generator-webapp 0.4.8
'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {

  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Turn on the stack trace by default
  grunt.option('stack', true);

  // Define the configuration for all the tasks
  grunt.initConfig({

    // Read the contents of the package file
    pkg: grunt.file.readJSON('package.json'),

    // Project settings
    config: {
      // Configurable paths
      app: {
        base: 'app',
        scripts: '<%= config.app.base %>/scripts',
        styles: '<%= config.app.base %>/styles',
        templates: '<%= config.app.base %>/templates',
        partials: '<%= config.app.base %>/partials',
        img: '<%= config.app.base %>/images'
      },

      dist: {
        base: 'content/themes/local-whistler',
        assets: '<%= config.dist.base %>/assets',
        scripts: '<%= config.dist.assets %>/scripts',
        img: '<%= config.dist.assets %>/images'
      },

      local: 'http://localwhistler.local',
      staging: 'http://lw-dev.simplebitdeign.com',
      live: 'http://localwhistler.com',

      banner: '/*' +
                'Theme Name: <%= pkg.title %>' +
                'Author: <%= pkg.author %>' +
                'Author URI: <%= pkg.authorURI %>' +
                'Description: <%= pkg.description %>' +
              '*/',

    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      // jadeTemplates: {
      //   files: ['<%= config.app.templates %>/*.jade', '<%= config.app.partials %>/*.jade'],
      //   tasks: ['jadephp:dist']
      // },
      coffee: {
        files: ['<%= config.app.scripts %>/{,*/}*.{coffee,litcoffee,coffee.md}'],
        tasks: ['coffee', 'jshint:dist', 'concat', 'uglify']
      },
      js: {
        files: ['<%= config.app.scripts %>/{,*/}*.js'],
        tasks: ['newer:copy:server', 'jshint:dist', 'concat', 'uglify']
      },
      gruntfile: {
        files: ['Gruntfile.js'],
        tasks: ['jshint:gruntfile']
      },
      // assets: {
      //   files: ['<%= config.app.img %>/{,*/}*.{webp,svg}', '<%= config.app.assets %>/fonts/{,*/}*.*'],
      //   tasks: ['newer:copy:all', 'newer:copy:dist']
      // },
      compass: {
        files: ['<%= config.app.styles %>/{,*/}*.{scss,sass}'],
        tasks: ['compass:server', 'autoprefixer', 'cssmin']
      },
      styles: {
        files: ['<%= config.app.styles %>/{,*/}*.css'],
        tasks: ['newer:copy:all', 'autoprefixer', 'cssmin']
      },
      livereload: {
        options: {
          livereload: '<%= connect.options.livereload %>'
        },
        files: [
          '<%= config.dist.base %>/{,*/}*.php',
          '.tmp/styles/{,*/}*.css',
          '.tmp/scripts/{,*/}*.js',
          '<%= config.app.img %>/{,*/}*'
        ]
      }
    },

    // The actual grunt server settings
    connect: {
      options: {
        port: 9000,
        livereload: 35729,
        // Change this to '0.0.0.0' to access the server from outside
        hostname: '0.0.0.0'
      },
      livereload: {
        options: {
          open: '<%= config.local %>',
          base: [
            '.tmp',
            '<%= config.app.base %>'
          ]
        }
      },
      dist: {
        options: {
          open: '<%= config.local %>',
          base: '<%= config.dist.base %>',
          livereload: false
        }
      }
    },

    // Empties folders to start fresh
    clean: {
      all: {
        files: [{
          dot: true,
          src: [
            '.tmp',
            // '<%= config.dist.base %>/*',
            '<%= config.dist.assets %>/*',
            '<%= cssmin.all.dest %>'
          ]
        }]
      }
    },

    // Compile Jade to HTML
    jadephp: {
      options: {
        pretty: true
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: '<%= config.app.templates %>/',
            dest: '<%= config.dist.base %>',
            src: '*.jade',
            ext: '.php'
          },{
            expand: true,
            cwd: '<%= config.app.partials %>/',
            dest: '<%= config.dist.base %>',
            src: '*.jade',
            ext: '.php'
          }
        ]
      },
    },

    // Make sure code styles are up to par and there are no obvious mistakes
    jshint: {
      options: {
        jshintrc: '.jshintrc',
        reporter: require('jshint-stylish')
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      dist: {
        src: '.tmp/scripts/{,*/}.js'
      }
    },

    // Compiles CoffeeScript to JavaScript
    coffee: {
      options: {
        bare: true
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app.scripts %>/',
          src: '{,*/}*.{coffee,litcoffee,coffee.md}',
          dest: '.tmp/scripts',
          ext: '.js'
        }]
      },
    },

    // Compiles Sass to CSS and generates necessary files if requested
    compass: {
      options: {
        config: 'config.rb',
        sourcemap: true
      },
      dist: {
        options: {
          debugInfo: false
        }
      },
      server: {
        options: {
          debugInfo: true
        }
      }
    },

    // Add vendor prefixed styles
    autoprefixer: {
      options: {
        browsers: ['last 2 versions']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '.tmp/styles/',
          src: '{,*/}*.css',
          dest: '.tmp/styles/'
        }]
      }
    },

    // Automatically inject Bower components into the HTML file
    bowerInstall: {
      app: {
        src: ['<%= config.app.partials %>/{,*/}*.jade'],
        ignorePath: '<%= config.app.base %>/',
        exclude: ['<%= config.app.base %>/bower_components/bootstrap-sass/vendor/assets/javascripts/bootstrap.js', ],
      },
      sass: {
        src: ['<%= config.app.styles %>/{,*/}*.{scss,sass}'],
        ignorePath: '<%= config.app.base %>/bower_components/'
      }
    },

    concat: {
      options: {
        stripBanners: true
      },
      all: {
        src: '.tmp/scripts/{,*/}*.js',
        dest: '.tmp/scripts/concat/script.js'
      }
    },

    uglify: {
      options: {
        compress: true,
        mangle: true,
        sourceMap: true
      },
      all: {
        src: '<%= concat.dest =>',
        dest: '<%= config.dist.scripts %>/script.js'
      }
    },

    cssmin: {
      options: {
        banner: '<%= banner %>',
        compress: true,
        keepSpecialComments: false
      },
      all: {
        src: '.tmp/styles/{,*/}*.css',
        dest: '<%= config.dist.base %>/style.css'
      }
    },

    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= config.app.img %>/',
          src: '{,*/}*.{gif,jpeg,jpg,png}',
          dest: '<%= config.dist.img %>'
        }]
      }
    },

    // Copies remaining files to places other tasks can use
    copy: {
      all: {
        files: [
          {
            expand: true,
            dot: true,
            cwd: '<%= config.app.base %>/',
            dest: '<%= config.dist.base %>',
            src: [
              '*.{ico,png,txt,svg,php,md}',
              '.htaccess',
              'README'
            ]
          }
        ]
      },

      server: {
        files: [
          {
            expand: true,
            dot: true,
            cwd: '<%= config.app.base %>/',
            dest: '.tmp',
            src: '{,*/}*.js'
          }
        ]
      },

      dist: {
        files: [
          {
            expand: true,
            dot: true,
            cwd: '<%= config.app.base %>/',
            dest: '<%= config.dist.assets %>',
            src: [
              'images/{,*/}*.{webp,svg}',
              'fonts/{,*/}*.*'
            ]
          }
        ]
      }
    },

    // Generates a custom Modernizr build that includes only the tests you
    // reference in your app
    modernizr: {
      devFile: '<%= config.app.base %>/bower_components/modernizr/modernizr.js',
      outputFile: '<%= config.dist.scripts %>/modernizr-custom.js',
      files: [
        '<%= config.dist.scripts %>/{,*/}*.js',
        '<%= config.dist.styles %>/{,*/}*.css',
        '!<%= config.dist.scripts %>/vendor/*'
      ],
      uglify: true,
      extra: {
        shiv: false,
        load: false
      }
    },

    bump: {
      options: {
        files: ['package.json', 'bower.json'],
        push: true,
        pushTo: 'origin',
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        commitFiles: ['<%= bump.options.files %>', 'CHANGELOG.md'],
        commitMessage: 'Bumped version to v%VERSION%'
      }
    },

    changelog: {
      options: {
        editor: 'atom -w'
      }
    },

    // Run some tasks in parallel to speed up build process
    concurrent: {
      options: {
        logConcurrentOutput: true,
        limit: 5
      },
      server: [
        'compass:server',
        'newer:coffee',
      ],
      dist: [
        'compass:dist',
        'coffee',
        'imagemin'
      ]
    }
  });

  grunt.registerTask('serve', function () {

    grunt.task.run([
      'clean',
      // 'jadephp:dist',
      'concurrent:server',
      'autoprefixer',
      'copy:dist',
      'newer:concat',
      'newer:uglify',
      'newer:cssmin',
      'connect:livereload',
      'watch'
    ]);
  });

  grunt.registerTask('server', function (target) {
    grunt.log.warn('The `server` task has been deprecated. Use `grunt serve` to start a server.');
    grunt.task.run([target ? ('serve:' + target) : 'serve']);
  });

  grunt.registerTask('default', [
    'clean',
    // 'jadephp:dist',
    'concurrent:dist',
    'jshint',
    'autoprefixer',
    'copy:dist',
    'concat',
    'uglify',
    'cssmin',
    'modernizr',
    'connect:dist'
  ]);

};
