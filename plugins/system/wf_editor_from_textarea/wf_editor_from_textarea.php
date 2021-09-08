<?php

/**
 * @copyright   Copyright (C) 2021 Ryan Demmer. All rights reserved
 * @license     GNU General Public License version 2 or later
 */
defined('JPATH_BASE') or die;

class PlgSystemWf_Editor_From_Textarea extends JPlugin
{
    private function createEditorTextArea($matches) {
        $data   = $matches[1];
        $html   = $matches[2];

        // get attributes
        $attribs = JUtility::parseAttributes(trim($data));

        $selector = $this->params->get('selector', '');

        if (empty($selector)) {
            $matches[0];
        }
 
        // remove "dot" if present
        $selector = trim($selector, '.');

        if (!empty($attribs['class'])) {
            $classValue = explode(' ', $attribs['class']);

            // custom selector - process these textareas as custom editors
            if (!in_array($selector, $classValue)) {
                return $matches[0];
            }
        }

        $id     = null;
        $name   = null;

        // trim whitespace from html
        $html = trim($html);

        if (!empty($attribs['name'])) {
            $name = $attribs['name'];
        }

        if (!empty($attribs['id'])) {
            $id = $attribs['id'];
        }

        $width  = $this->params->get('width', '100%');
        $height = $this->params->get('height', '100%');

        $editor = JFactory::getConfig()->get('editor');
        $instance = JEditor::getInstance($editor);
        return $instance->display($name, $html, $width, $height, 20, 20, true, $id, null, null, array('attributes' => $attribs));
    }

    /**
     * Process textarea elements for custom editor instances.
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property.
     * @param   mixed    &$params  Additional parameters.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  void
     */
    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Don't run this plugin when the content is being indexed
        if ($context == 'com_finder.indexer') {
            return true;
        }

        // don't process if there is not text
        if (empty($row->text)) {
            return true;
        }

        /*
         * Check for presence of required <textarea> tag
         */
        if (JString::strpos($row->text, '<textarea') === false) {
            return true;
        }

        $row->text = preg_replace_callback('#<textarea([^>]+)>([\s\S]*?)<\/textarea>#i', array($this, 'createEditorTextArea'), $row->text);
    }
}
