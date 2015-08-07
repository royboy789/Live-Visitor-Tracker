var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');


gulp.task('js', function(){
	
	gulp.src('assets/js/*.js')
	.pipe(gulp.dest('build/js'));
	
	gulp.src('assets/js/public/*.js')
	.pipe(concat('wp_livetracker_public.js'))
	.pipe(uglify())
	.pipe(gulp.dest('build/js/public'));
	
	gulp.src('assets/js/admin/*.js')
	.pipe(concat('wp_livetracker_admin.js'))
	.pipe(uglify())
	.pipe(gulp.dest('build/js/admin'));
})