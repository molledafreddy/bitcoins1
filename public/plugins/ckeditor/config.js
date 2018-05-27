/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'es';
	config.width = '100%';
	config.height = 400;  
	config.filebrowserBrowseUrl = '/browser/browse.php';
	config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images',
	config.filebrowserImageUploadUrl = '/laravel-filemanager/upload?type=Images&_token=',
    config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files',
    config.filebrowserUploadUrl = '/laravel-filemanager/upload?type=Files&_token='
	 // config.filebrowserUploadUrl = '/uploader/upload.php';
	// config.uiColor = '#AADC6E';
};
