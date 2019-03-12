<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>

function generateSlug(src, target) {
    $(target).attr('value', $(src).val().toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,''))
}

function renderIcon(src, holder) {
    $(holder).html($(src).val()).text()
}

function findEI(id) {
    var request = $.ajax({
        url: "/dashboard/essential_information/find",
        method: "GET",
        data: {
            'id': id
        }
    })
    request.done(function(data) {
        loadingSpinner(false)
        if (data.id != undefined) {
            $('#inputIdEdit').attr('value', data.id)
            $('#inputTitleEdit').attr('value', data.title)
            $('#inputSlugEdit').attr('value', data.slug)
            $('#inputOrderingEdit').attr('value', data.ordering)
            $('#inputPositionEdit option[value="'+data.position+'"]').attr('selected','selected')
            $('#inputVisibilityEdit option[value="'+data.visibility+'"]').attr('selected','selected')
            $('#inputMaterialIconEdit').attr('value', data.material_icon)
            $('#edit_mi').html(data.material_icon).text()
            $('#inputBriefDescriptionEdit').text(data.brief_description)
            $('#inputBriefDescriptionEditLength').text(data.brief_description.length)
            $('#inputFullDescriptionEdit').trumbowyg('html', data.full_description);
            $('#updateModal').modal('show')
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        console.log(jqXHR.responseJSON)
    })
}

function addEI() {
    if (!confirm('<?php echo lang('L_CONFIRM_ADD_E_INFORMATION')?>')) {
        return;
    }
    $('#add_essential_information').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleError').removeClass('border-danger')
    $('#inputTitleErrorText').text('')
    $('#inputSlugError').removeClass('border-danger')
    $('#inputSlugErrorText').text('')
    $('#inputOrderingError').removeClass('border-danger')
    $('#inputOrderingErrorText').text('')
    $('#inputPositionError').removeClass('border-danger')
    $('#inputPositionErrorText').text('')
    $('#inputVisibilityError').removeClass('border-danger')
    $('#inputVisibilityErrorText').text('')
    $('#inputMaterialIconError').removeClass('border-danger')
    $('#inputMaterialIconErrorText').text('')
    $('#inputBriefDescriptionError').removeClass('border-danger')
    $('#inputBriefDescriptionErrorText').text('')
    $('#inputFullDescriptionError').removeClass('border-danger')
    $('#inputFullDescriptionErrorText').text('')
    var data = {
        'title': $('#inputTitle').val(),
        'slug': $('#inputSlug').val(),
        'ordering': $('#inputOrdering').val(),
        'position': $('#inputPosition').val(),
        'visibility': $('#inputVisibility').val(),
        'material_icon': $('#inputMaterialIcon').val(),
        'brief_description': $('#inputBriefDescription').val(),
        'full_description': $('#inputFullDescription').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/add",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('#add_essential_information').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.full_description != undefined) {
                    $('#inputFullDescriptionError').addClass('border-danger')
                    $('#inputFullDescriptionErrorText').text(jqXHR.responseJSON.errors.full_description)
                }
                if (jqXHR.responseJSON.errors.brief_description != undefined) {
                    $('#inputBriefDescriptionError').addClass('border-danger')
                    $('#inputBriefDescriptionErrorText').text(jqXHR.responseJSON.errors.brief_description)
                }
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingError').addClass('border-danger')
                    $('#inputOrderingErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.slug != undefined) {
                    $('#inputSlugError').addClass('border-danger')
                    $('#inputSlugErrorText').text(jqXHR.responseJSON.errors.slug)
                }
                if (jqXHR.responseJSON.errors.title != undefined) {
                    $('#inputTitleError').addClass('border-danger')
                    $('#inputTitleErrorText').text(jqXHR.responseJSON.errors.title)
                }
                if (jqXHR.responseJSON.errors.position != undefined) {
                    $('#inputPositionError').addClass('border-danger')
                    $('#inputPositionErrorText').text(jqXHR.responseJSON.errors.position)
                }
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityError').addClass('border-danger')
                    $('#inputVisibilityErrorText').text(jqXHR.responseJSON.errors.visibility)
                }
                if (jqXHR.responseJSON.errors.material_icon != undefined) {
                    $('#inputMaterialIconError').addClass('border-danger')
                    $('#inputMaterialIconErrorText').text(jqXHR.responseJSON.errors.material_icon)
                }
            }
        }
    })
}

function updateEI() {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', $('#inputTitleEdit').val()))) {
        return;
    }
    $('#update_essential_information').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleEditError').removeClass('border-danger')
    $('#inputTitleEditErrorText').text('')
    $('#inputSlugEditError').removeClass('border-danger')
    $('#inputSlugEditErrorText').text('')
    $('#inputOrderingEditError').removeClass('border-danger')
    $('#inputOrderingEditErrorText').text('')
    $('#inputPositionEditError').removeClass('border-danger')
    $('#inputPositionEditErrorText').text('')
    $('#inputVisibilityEditError').removeClass('border-danger')
    $('#inputVisibilityEditErrorText').text('')
    $('#inputMaterialIconEditError').removeClass('border-danger')
    $('#inputMaterialIconEditErrorText').text('')
    $('#inputBriefDescriptionEditError').removeClass('border-danger')
    $('#inputBriefDescriptionEditErrorText').text('')
    $('#inputFullDescriptionEditError').removeClass('border-danger')
    $('#inputFullDescriptionEditErrorText').text('')
    var data = {
        'id': $('#inputIdEdit').val(),
        'title': $('#inputTitleEdit').val(),
        'slug': $('#inputSlugEdit').val(),
        'ordering': $('#inputOrderingEdit').val(),
        'position': $('#inputPositionEdit').val(),
        'visibility': $('#inputVisibilityEdit').val(),
        'material_icon': $('#inputMaterialIconEdit').val(),
        'brief_description': $('#inputBriefDescriptionEdit').val(),
        'full_description': $('#inputFullDescriptionEdit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/update",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('#update_essential_information').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.full_description != undefined) {
                    $('#inputFullDescriptionEditError').addClass('border-danger')
                    $('#inputFullDescriptionEditErrorText').text(jqXHR.responseJSON.errors.full_description)
                }
                if (jqXHR.responseJSON.errors.brief_description != undefined) {
                    $('#inputBriefDescriptionEditError').addClass('border-danger')
                    $('#inputBriefDescriptionEditErrorText').text(jqXHR.responseJSON.errors.brief_description)
                }
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingEditError').addClass('border-danger')
                    $('#inputOrderingEditErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.slug != undefined) {
                    $('#inputSlugEditError').addClass('border-danger')
                    $('#inputSlugEditErrorText').text(jqXHR.responseJSON.errors.slug)
                }
                if (jqXHR.responseJSON.errors.title != undefined) {
                    $('#inputTitleEditError').addClass('border-danger')
                    $('#inputTitleEditErrorText').text(jqXHR.responseJSON.errors.title)
                }
                if (jqXHR.responseJSON.errors.position != undefined) {
                    $('#inputPositionEditError').addClass('border-danger')
                    $('#inputPositionEditErrorText').text(jqXHR.responseJSON.errors.position)
                }
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityEditError').addClass('border-danger')
                    $('#inputVisibilityEditErrorText').text(jqXHR.responseJSON.errors.visibility)
                }
                if (jqXHR.responseJSON.errors.material_icon != undefined) {
                    $('#inputMaterialIconEditError').addClass('border-danger')
                    $('#inputMaterialIconEditErrorText').text(jqXHR.responseJSON.errors.material_icon)
                }
            }
        }
    })
}

function updateOrderEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputOrdering'+id).removeClass('border-danger')
    $('#inputOrderingErrorText'+id).text('')
    var data = {
        'id': id,
        'ordering': $('#inputOrdering'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/update_order",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('button').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingError'+id).addClass('border-danger')
                    $('#inputOrderingErrorText'+id).text(jqXHR.responseJSON.errors.ordering)
                }
            }
        }
    })
}

function updatePositionEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputPosition'+id).removeClass('border-danger')
    $('#inputPositionErrorText'+id).text('')
    var data = {
        'id': id,
        'position': $('#inputPosition'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/update_position",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('button').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.position != undefined) {
                    $('#inputPositionError'+id).addClass('border-danger')
                    $('#inputPositionErrorText'+id).text(jqXHR.responseJSON.errors.position)
                }
            }
        }
    })
}

function updateVisibilityEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputVisibility'+id).removeClass('border-danger')
    $('#inputVisibilityErrorText'+id).text('')
    var data = {
        'id': id,
        'visibility': $('#inputVisibility'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/update_visibility",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('button').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityError'+id).addClass('border-danger')
                    $('#inputVisibilityErrorText'+id).text(jqXHR.responseJSON.errors.visibility)
                }
            }
        }
    })
}

function updateIconEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputMaterialIcon'+id).removeClass('border-danger')
    $('#inputMaterialIconErrorText'+id).text('')
    var data = {
        'id': id,
        'material_icon': $('#inputMaterialIcon'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/update_icon",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('button').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityError'+id).addClass('border-danger')
                    $('#inputVisibilityErrorText'+id).text(jqXHR.responseJSON.errors.visibility)
                }
                if (jqXHR.responseJSON.errors.material_icon != undefined) {
                    $('#inputMaterialIconError'+id).addClass('border-danger')
                    $('#inputMaterialIconErrorText'+id).text(jqXHR.responseJSON.errors.material_icon)
                }
            }
        }
    })
}

function deleteEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_DELETE_E_INFORMATION')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    var data = {
        'id': id,
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/essential_information/delete",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        console.log(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('button').removeAttr("disabled")
        if (jqXHR.responseJSON.message != undefined) {
            showDangerMessage(jqXHR.responseJSON.message)
        }
    })
}
</script>
