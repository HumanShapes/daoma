/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    // aws: grunt.file.readJSON('~/_toolbox/grunt-aws.json'),
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration below.
    grunticon: {
      icons: {
        options: {
          src: "../svgs/",
          dest: "../icons/",
          datasvgcss: "icons.data.svg.scss",
          datapngcss: "icons.data.png.scss",
          urlpngcss: "icons.fallback.scss"
        }
      }
    },
     // Includes allow us to have partials in HTML
    includes: {
      files: {
        src: ['../*.html'],
        dest: '../dev/',
        flatten: true,
        debug: true
      }
    },
    sass: {
      build: {
        files: {
          '../dev/css/compiled.data.svg.css': ['../css/compile.svg.scss'],
          '../dev/css/compiled.data.png.css': ['../css/compile.png.scss'],
          '../dev/css/compiled.fallback.css': ['../css/compile.fallback.scss'],
          '../dev/css/welcomefade.css': ['../css/welcomefade.scss'],
          '../dev/css/mediaqueries.css': ['../css/mediaqueries.scss']
        }
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        // Add any javascript files in the main JS directory or in the vendor directory to the compiled file
        src: ['../js/vendor/*.js','../js/*.js','../js/vendor/!(modernizr).js'],
        dest: '../dev/js/compiled.js'
      }
    },
    watch: {
      html: {
        options: {
          interrupt: true,
          livereload: true
        },
        files: ['../*.html', '../includes/*.html'],
        tasks: ['includes']
      },
      css: {
        options: {
          interrupt: true,
          livereload: true
        },
        files: ['../css/*.scss'],
        tasks: ['sass']
      },
      js: {
        options: {
          interrupt: true,
          livereload: true
        },
        files: ['../js/*.js','../js/vendor/*.js', '../js/vendor/!(modernizr).js'],
        tasks: ['concat','uglify']
      }
      // icons: {
      //   options: {
      //     interrupt: true,
      //     livereload: true
      //   },
      //   files: ['../svgs/*'],
      //   tasks: ['grunticon']
      // }
    },
    copy: {
      dev: {
        files: [
          {expand: true, cwd: '../icons/', src: ['png/**'], dest: '../dev/css/'},
          // {expand: true, flatten: true, cwd: '../', src: ['favicons/*'], dest: '../dev/'},
          {expand: true, cwd: '../', src: ['img/**/*'], dest: '../dev/'},
          {expand: true, cwd: '../', src: ['js/vendor/modernizr.js'], dest: '../dev/'},
          {expand: true, cwd: '../', src: ['type/*'], dest: '../dev/'},
        ]
      }
    },
    uglify: {
      build: {
        files: {
          '../dev/js/compiled.min.js' : '../dev/js/compiled.js'
        }
      }
    }
    // ,
    // s3: {
    //   options: {
    //     key: '<%= aws.key %>',
    //     secret: '<%= aws.secret %>',
    //     bucket: '<%= aws.bucket %>',
    //     access: 'public-read',
    //     headers: {
    //     // Two Year cache policy (1000 * 60 * 60 * 24 * 730)
    //     "Cache-Control": "max-age=630720000, public",
    //     "Expires": new Date(Date.now() + 63072000000).toUTCString()
    //   }
    //   },
    //   live: {
    //     upload: [
    //       {
    //         src: '../dev/css/*.css',
    //         dest: '/css/',
    //         gzip: true
    //       },
    //       {
    //         src: '../dev/*.js',
    //         dest: '/js/',
    //         gzip: true
    //       },
    //       {
    //         src: '../dev/*.html',
    //         dest: '/'
    //       },
    //       {
    //         src: '../dev/img/*',
    //         dest: '/img/'
    //       },
    //       {
    //         src: '../dev/css/png/*',
    //         dest: '/css/png'
    //       }
    //     ]
    //   }
    // }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-grunticon');
  grunt.loadNpmTasks('grunt-includes');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-s3');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // grunt.loadNpmTasks('grunt-svgmin');
  // grunt.loadNpmTasks('grunt-contrib-imagemin');

  // Default task.
  grunt.registerTask('default', ['copy:dev','includes','sass','concat','uglify']);
  grunt.registerTask('icons', ['grunticon']);
  // This is the build process for development
  // grunt.registerTask('staging', ['s3:dev']);
  // grunt.registerTask('staging-full', ['s3']);

};
