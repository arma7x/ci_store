<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
function triggerIcon(selector) {
    $(selector).click()
}

function renderIcon(src, holder) {
    $(holder).attr('src', $(src).val())
}

function setIconCbAdd(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolder')
}

function setIconCbEdit(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolderEdit')
}

function setIconByUrl(selector, holder) {
    var data = prompt('<?php echo lang('L_CAT_ICON_PLACEHOLDER')?>')
    if (data != undefined || date.length > 0) {
        $(selector).val(data)
        renderIcon(selector, holder)
    }
}

function findCategory(id) {
    var request = $.ajax({
        url: "/dashboard/category/find",
        method: "GET",
        data: {
            'id': id
        }
    })
    request.done(function(data) {
        loadingSpinner(false)
        if (data.id != undefined) {
            $('#inputIdEdit').attr('value', data.id)
            $('#inputNameEdit').attr('value', data.name)
            $('#inputOrderingEdit').attr('value', data.ordering)
            $('#inputIconEdit').text(data.icon)
            $('#iconHolderEdit').attr('src', data.icon)
            $('#updateInboxModal').modal('show')
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        console.log(jqXHR.responseJSON)
    })
}

function addCategory() {
    if (!confirm('<?php echo lang('L_CONFIRM_ADD_CATEGORY')?>')) {
        return;
    }
    $('#add_category').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputNameError').removeClass('border-danger')
    $('#inputNameErrorText').text('')
    $('#inputOrderingError').removeClass('border-danger')
    $('#inputOrderingErrorText').text('')
    $('#inputIconError').removeClass('border-danger')
    $('#inputIconErrorText').text('')
    var data = {
        'name': $('#inputName').val(),
        'ordering': $('#inputOrdering').val(),
        'icon': $('#inputIcon').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/category/add",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        alert(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('#add_category').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.icon != undefined) {
                    $('#inputIconError').addClass('border-danger')
                    $('#inputIconErrorText').text(jqXHR.responseJSON.errors.icon)
                }
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingError').addClass('border-danger')
                    $('#inputOrderingErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.name != undefined) {
                    $('#inputNameError').addClass('border-danger')
                    $('#inputNameErrorText').text(jqXHR.responseJSON.errors.name)
                }
            }
        }
    })
}

function updateCategory() {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_CATEGORY')?>'
    if (!confirm(text.replace('%s', $('#inputNameEdit').val()))) {
        return;
    }
    $('#update_category').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleEditError').removeClass('border-danger')
    $('#inputTitleEditErrorText').text('')
    $('#inputOrderingEditError').removeClass('border-danger')
    $('#inputOrderingEditErrorText').text('')
    $('#inputBriefDescriptionEditError').removeClass('border-danger')
    $('#inputBriefDescriptionEditErrorText').text('')
    $('#inputFullDescriptionEditError').removeClass('border-danger')
    $('#inputFullDescriptionEditErrorText').text('')
    var data = {
        'id': $('#inputIdEdit').val(),
        'name': $('#inputNameEdit').val(),
        'ordering': $('#inputOrderingEdit').val(),
        'icon': $('#inputIconEdit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/category/update",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        alert(data.message)
        if (data.redirect != undefined) {
            Turbolinks.visit(data.redirect, { action: "replace" })
        } else {
            document.location.reload()
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('#update_category').removeAttr("disabled")
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
                if (jqXHR.responseJSON.errors.title != undefined) {
                    $('#inputTitleEditError').addClass('border-danger')
                    $('#inputTitleEditErrorText').text(jqXHR.responseJSON.errors.title)
                }
            }
        }
    })
}

function updateOrderCategory(id, name) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_CATEGORY')?>'
    if (!confirm(text.replace('%s', name))) {
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
        url: "/dashboard/category/update_order",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        alert(data.message)
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

function deleteCategory(id, name) {
    var text = '<?php echo lang('L_CONFIRM_DELETE_CATEGORY')?>'
    if (!confirm(text.replace('%s', name))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    var data = {
        'id': id,
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/category/delete",
        method: "POST",
        data: data,
        dataType: "json"
    })
    request.done(function(data) {
        alert(data.message)
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
