const $ = require('jquery');
import * as bootstrap from 'bootstrap';

/**
 * Handle the creation of a new paste
 *
 * @param {jQuery.Event} e The event that triggered the function call
 * @returns {undefined}
 */
function handleNewPaste(e) {
    // Get the paste contents
    const pasteContent = $('#new-paste-form textarea').val();

    // Create the paste
    $.post('/api/paste', {
        content: pasteContent
    }, null, 'json').then(function(response) {
        console.log(response);

        // Extract the slug
        const slug = response.slug;

        // Update the modal contents
        $('#success-modal .paste-url').each(function() {
            $(this).attr('href', response.url);
        });
        $('#success-modal #paste-edit-url').val(response.edit_url);

        // Open the modal
        const modal = new bootstrap.Modal($('#success-modal'));
        modal.show();
    });
}

/**
 * Handle updating a paste
 *
 * @param {jQuery.Event} e The event that triggered the function call
 * @returns {undefined}
 */
function handlePasteUpdate(e) {
    // Get the paste slug
    const slug = $('#update-paste-form').data('paste-slug');

    // Get the signature
    const updateUrl = $('#update-paste-form').data('update-url');

    // Get the paste content
    const pasteContent = $('#update-paste-form textarea').val();

    // Make the API call
    $.post(updateUrl, {
        content: pasteContent,
        _method: 'PUT'
    }).then(function(response) {
        // Update the modal contents
        $('#success-modal .paste-url').each(function() {
            $(this).attr('href', response.url);
        });

        // Open the modal
        const modal = new bootstrap.Modal($('#success-modal'));
        modal.show();
    });
}

// Wait for the DOM
$(function() {
    // Check for the new paste form which only exists on the home page
    if ($('#new-paste-form').length > 0) {
        // Register the handler
        $('#new-paste-form button').click(handleNewPaste);
    } else if ($('#update-paste-form').length > 0) {
        // Register the handler for the update page
        $('#update-paste-form button').click(handlePasteUpdate);
    } else if ($('#paste-content').length > 0) {
        // Resize the textarea
        $('#paste-content').height($('#paste-content')[0].scrollHeight);
    }
});
