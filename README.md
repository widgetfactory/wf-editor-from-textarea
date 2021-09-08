# Wf Editor From Textarea
Convert any textarea in Joomla content into a Joomla WYSIWYG Editor

## Download
Downloads are available in [Releases](https://github.com/widgetfactory/wf-editor-from-textarea/releases/).

## Installation
Install using the Joomla Extensions Installer and enable after installation.

https://docs.joomla.org/Installing_an_extension

## Configuration and Usage
Only textarea elements identified by a class selector will be converted. So for example:
```html
<textarea name="my_content" class="custom-editor">Some default content...</textarea>
```
will be converted into an editor if the **Editor Selector** is set as _custom-editor_.

The **Editor Selector** needs to be set in the plugins parameters, in Extensions -> Plugins, eg:

![Plugin Configuration](https://cdn.joomlacontenteditor.net/images/docs/wf-editor-from-textarea/edtitor-from-textarea-config.jpg)

An optional **Width** and **Height** for the editor can also be set.

When a page is loaded containing a textarea identified by the selector, the textarea will be converted to the default or user assigned Joomla Editor.

## Bug Reports / Support / Issues
This plugin is in beta, so expect some probelms. Please use the Gitub Issue tracker to tell us about a any you've found.
