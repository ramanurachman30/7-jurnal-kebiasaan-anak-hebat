const
	gulp = require('gulp'),
	sourcemaps = require('gulp-sourcemaps'),
	concat = require('gulp-concat'),
	connect = require('gulp-connect-php'),
	browserSync = require('browser-sync'),
	sass = require('gulp-sass')(require('sass')),
	htmlmin = require('gulp-htmlmin'),
	webpack = require('webpack-stream'),
	webp = require('gulp-webp'),
	svgmin = require('gulp-svgmin'),
	autoprefixer = require('gulp-autoprefixer'),
	tailwindcss = require('tailwindcss'),
	postcss = require('gulp-postcss'),
	rename = require('gulp-rename');

function tailwind() {
	return gulp.src('resources/css/public.scss')
		.pipe(sourcemaps.init())
		.pipe(postcss([
			tailwindcss('./tailwind.config.js'),
			require('autoprefixer')
		]))
		.pipe(rename('public.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('.cache/css/'));
}

function js() {
	return gulp.src([
		'public/assets/frontend/js/prism.js',
		'public/assets/js/custom/components/sweetalert2@11.js',
		'public/assets/frontend/js/main.js',
		'public/assets/js/custom/pages/galleries/carousel.js',
	])
		.pipe(webpack({
			devtool: 'source-map',
			mode: 'production',
			output: {
				filename: 'bundle.js',
				clean: true
			}
		}))
		.pipe(gulp.dest('public/assets/frontend/dist/js/'))
		.pipe(browserSync.stream());
}

function css() {
	return gulp.src([
		'public/assets/frontend/bootstrap/css/bootstrap.min.css',
		'public/assets/frontend/Montserrat/stylesheet.css',
		'public/assets/frontend/css/tiny-slider.css',
		'public/assets/frontend/css/style.scss',
		'public/assets/frontend/css/custom.css',
	]) //masukan css disini
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(sass.sync({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(concat("bundle.css"))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('.cache/css/'));
}
// function font() {
// 	return gulp.src('src/fonts/*.woff')
// }
gulp.task('copy-font', function () {
  return gulp.src('public/assets/frontend/Montserrat-woff/*.woff')
    .pipe(rename({ dirname: '' })) // This removes any subdirectories when copying
    .pipe(gulp.dest('dist/fonts')); // Change 'dist/fonts' to your desired destination
});

// function print() {
// 	return gulp.src([
// 		'css/print.scss'
// 	])
// 		.pipe(sourcemaps.init({ loadMaps: true }))
// 		.pipe(sass.sync({ outputStyle: 'compressed' }).on('error', sass.logError))
// 		.pipe(concat("print.css"))
// 		.pipe(sourcemaps.write("."))
// 		.pipe(gulp.dest('.cache/css/'));
// }

function css_prefix() {
	return gulp.src(['.cache/css/*.css'])
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(autoprefixer())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('public/assets/frontend/dist/css/'))
		.pipe(browserSync.stream());
}

// function php() {
// 	return gulp.src(['*.php', '*.png', '*.ico', '*.webmanifest', '*.txt', '*.xml'])
// 		.pipe(gulp.dest('dist/'))
// 		.pipe(browserSync.stream());
// }

// function img() {
// 	return gulp.src([
// 		'img/*.jpg',
// 		'img/*.png',
// 		'img/*/*.jpg',
// 		'img/*/*.png'
// 	])
// 		.pipe(webp())
// 		.pipe(gulp.dest('dist/img/'))
// 		.pipe(browserSync.stream());
// }

// function svg() {
// 	return gulp.src(['img/*.svg', 'img/*/*.svg'])
// 		.pipe(svgmin())
// 		.pipe(gulp.dest('dist/img/'))
// 		.pipe(browserSync.stream());
// }

exports.default = function () {
	browserSync.init({
		proxy: "127.0.0.1:8000/"
	});
	gulp.watch('gulpfile.js', process.exit);
	// gulp.watch(['js/*.js', 'js/*/*.js'], { ignoreInitial: false }, js);
	gulp.watch(['public/assets/frontend/js/*.js', 'public/assets/frontend/js/*/*.js'], { ignoreInitial: false }, js);
	// gulp.watch(['css/main.scss'], { ignoreInitial: false }, css);
	gulp.watch(['public/assets/frontend/css/*.scss', 'public/assets/frontend/css/*.css'], { ignoreInitial: false }, css);
	// gulp.watch(['css/print.scss'], { ignoreInitial: false }, print);
	gulp.watch(['.cache/css/*.css'], { ignoreInitial: false }, css_prefix);
	// gulp.watch(['img/*.jpg', 'img/*.png', 'img/*/*.jpg', 'img/*/*.png'], { ignoreInitial: false }, img);
	// gulp.watch(['img/*.svg', 'img/*/*.svg'], { ignoreInitial: false }, svg);
	// gulp.watch(['*.php'], { ignoreInitial: false }, php);
	gulp.watch(['resources/css/public.scss'], { ignoreInitial: false }, tailwind);
}