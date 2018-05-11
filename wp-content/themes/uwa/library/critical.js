var critical = require('critical');

critical.generate({
    src: 'https://uwa-gulp.dev',
    dest: 'css/build/minified/critical-home.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees',
    dest: 'css/build/minified/critical-online-degrees.css',
    minify: true,
    width: 1600,
    height: 1200
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/degree-levels/masters',
    dest: 'css/build/minified/critical-degree-levels.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/areas-of-study/business',
    dest: 'css/build/minified/critical-areas-study.css',
    minify: true,
    width: 1300,
    height: 900
});

critical.generate({
    src: 'https://uwa-gulp.dev/online-degrees/m-s-guidance-counseling',
    dest: 'css/build/minified/critical-program-page.css',
    minify: true,
    width: 1300,
    height: 900
});


critical.generate({
    src: 'https://uwa-gulp.dev/tuition/tuition-information',
    dest: 'css/build/minified/critical-interior.css',
    minify: true,
    width: 1300,
    height: 900
});
