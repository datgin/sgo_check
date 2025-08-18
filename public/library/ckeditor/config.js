/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    console.log(filemanager.ckBrowseUrl);

    config.filebrowserBrowseUrl = "/admin/filemanager?type=Files";
    config.filebrowserImageBrowseUrl =
        "/admin/filemanager/" + filemanager.ckBrowseUrl;
    config.filebrowserUploadUrl = "/admin/filemanager/upload?type=Files";
    config.filebrowserImageUploadUrl = "/admin/filemanager/upload?type=Images";
};
