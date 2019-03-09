<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
function updateGeneralInformation() {
    if (!confirm('<?php echo lang('L_CONFIRM_UPDATE_G_INFORMATION')?>')) {
        return;
    }
    $('#update_general_information').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputNameError').removeClass('border-danger')
    $('#inputNameErrorText').text('')
    $('#inputDescriptionError').removeClass('border-danger')
    $('#inputDescriptionErrorText').text('')
    $('#inputAddressError').removeClass('border-danger')
    $('#inputAddressErrorText').text('')
    $('#inputEmailAddressError').removeClass('border-danger')
    $('#inputEmailAddressErrorText').text('')
    $('#inputOfficeNumberError').removeClass('border-danger')
    $('#inputOfficeNumberErrorText').text('')
    $('#inputMobileNumberError').removeClass('border-danger')
    $('#inputMobileNumberErrorText').text('')
    $('#inputCurrencyUnitError').removeClass('border-danger')
    $('#inputCurrencyUnitErrorText').text('')
    var data = {
        'name': $('#inputName').val(),
        'description': $('#inputDescription').val(),
        'address': $('#inputAddress').val(),
        'email': $('#inputEmailAddress').val(),
        'office_number': $('#inputOfficeNumber').val(),
        'mobile_number': $('#inputMobileNumber').val(),
        'currency_unit': $('#inputCurrencyUnit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/general_information/update_general_information",
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
        $('#update_general_information').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.name != undefined) {
                    $('#inputNameError').addClass('border-danger')
                    $('#inputNameErrorText').text(jqXHR.responseJSON.errors.name)
                }
                if (jqXHR.responseJSON.errors.description != undefined) {
                    $('#inputDescriptionError').addClass('border-danger')
                    $('#inputDescriptionErrorText').text(jqXHR.responseJSON.errors.description)
                }
                if (jqXHR.responseJSON.errors.address != undefined) {
                    $('#inputAddressError').addClass('border-danger')
                    $('#inputAddressErrorText').text(jqXHR.responseJSON.errors.address)
                }
                if (jqXHR.responseJSON.errors.email != undefined) {
                    $('#inputEmailAddressError').addClass('border-danger')
                    $('#inputEmailAddressErrorText').text(jqXHR.responseJSON.errors.email)
                }
                if (jqXHR.responseJSON.errors.office_number != undefined) {
                    $('#inputOfficeNumberError').addClass('border-danger')
                    $('#inputOfficeNumberErrorText').text(jqXHR.responseJSON.errors.office_number)
                }
                if (jqXHR.responseJSON.errors.mobile_number != undefined) {
                    $('#inputMobileNumberError').addClass('border-danger')
                    $('#inputMobileNumberErrorText').text(jqXHR.responseJSON.errors.mobile_number)
                }
                if (jqXHR.responseJSON.errors.working_hours != undefined) {
                    $('#inputCurrencyUnitrError').addClass('border-danger')
                    $('#inputCurrencyUnitErrorText').text(jqXHR.responseJSON.errors.working_hours)
                }
            }
        }
    })
}

function triggerIcon(selector) {
    $(selector).click()
}

function renderIcon(src, holder) {
    $(holder).attr('src', $(src).val())
}

function setIconCbSCAdd(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolderSC')
}

function setIconCbSCEdit(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolderSCEdit')
}

function setIconCbICAdd(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolderIC')
}

function setIconCbICEdit(data, selector) {
    $(selector).val(data)
    renderIcon(selector, '#iconHolderICEdit')
}

function setIconByUrl(selector, holder) {
    var data = prompt('<?php echo lang('L_S_C_ICON_PLACEHOLDER')?>')
    if (data != undefined || date.length > 0) {
        $(selector).val(data)
        renderIcon(selector, holder)
    }
}

function findSocialChannel(id) {
    var request = $.ajax({
        url: "/dashboard/general_information/find_social_channel",
        method: "GET",
        data: {
            'id': id
        }
    })
    request.done(function(data) {
        loadingSpinner(false)
        if (data.id != undefined) {
            $('#inputIdSCEdit').attr('value', data.id)
            $('#inputNameSCEdit').attr('value', data.name)
            $('#inputURLSCEdit').attr('value', data.url)
            $('#inputOrderingSCEdit').attr('value', data.ordering)
            $('#inputIconSCEdit').text(data.icon)
            $('#iconHolderSCEdit').attr('src', data.icon)
            $('#updateSocialModal').modal('show')
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        console.log(jqXHR.responseJSON)
    })
}

function addSocialChannel() {
    if (!confirm('<?php echo lang('L_CONFIRM_ADD_SOCIAL_CHANNEL')?>')) {
        return;
    }
    $('#add_social_channel').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputNameSCError').removeClass('border-danger')
    $('#inputNameSCErrorText').text('')
    $('#inputURLSCError').removeClass('border-danger')
    $('#inputURLSCErrorText').text('')
    $('#inputOrderingSCError').removeClass('border-danger')
    $('#inputOrderingSCErrorText').text('')
    $('#inputIconSCError').removeClass('border-danger')
    $('#inputIconSCErrorText').text('')
    var data = {
        'name': $('#inputNameSC').val(),
        'url': $('#inputURLSC').val(),
        'ordering': $('#inputOrderingSC').val(),
        'icon': $('#inputIconSC').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/general_information/add_social_channel",
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
        $('#add_social_channel').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.icon != undefined) {
                    $('#inputIconSCError').addClass('border-danger')
                    $('#inputIconSCErrorText').text(jqXHR.responseJSON.errors.icon)
                }
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingSCError').addClass('border-danger')
                    $('#inputOrderingSCErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.url != undefined) {
                    $('#inputURLSCError').addClass('border-danger')
                    $('#inputURLSCErrorText').text(jqXHR.responseJSON.errors.url)
                }
                if (jqXHR.responseJSON.errors.name != undefined) {
                    $('#inputNameSCError').addClass('border-danger')
                    $('#inputNameSCErrorText').text(jqXHR.responseJSON.errors.name)
                }
            }
        }
    })
}

function updateSocialChannel() {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_SOCIAL_CHANNEL')?>'
    if (!confirm(text.replace('%s', $('#inputNameSCEdit').val()))) {
        return;
    }
    $('#update_social_channel').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleEditError').removeClass('border-danger')
    $('#inputTitleEditErrorText').text('')
    $('#inputSlugEditError').removeClass('border-danger')
    $('#inputSlugEditErrorText').text('')
    $('#inputOrderingEditError').removeClass('border-danger')
    $('#inputOrderingEditErrorText').text('')
    $('#inputBriefDescriptionEditError').removeClass('border-danger')
    $('#inputBriefDescriptionEditErrorText').text('')
    $('#inputFullDescriptionEditError').removeClass('border-danger')
    $('#inputFullDescriptionEditErrorText').text('')
    var data = {
        'id': $('#inputIdSCEdit').val(),
        'name': $('#inputNameSCEdit').val(),
        'url': $('#inputURLSCEdit').val(),
        'ordering': $('#inputOrderingSCEdit').val(),
        'icon': $('#inputIconSCEdit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/general_information/update_social_channel",
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
        $('#update_social_channel').removeAttr("disabled")
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
            }
        }
    })
}

function updateOrderSocialChannel(id, name) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_SOCIAL_CHANNEL')?>'
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
        url: "/dashboard/general_information/update_social_channel_order",
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

function deleteSocialChannel(id, name) {
    var text = '<?php echo lang('L_CONFIRM_DELETE_SOCIAL_CHANNEL')?>'
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
        url: "/dashboard/general_information/delete_social_channel",
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

function findInboxChannel(id) {
    var request = $.ajax({
        url: "/dashboard/general_information/find_inbox_channel",
        method: "GET",
        data: {
            'id': id
        }
    })
    request.done(function(data) {
        loadingSpinner(false)
        if (data.id != undefined) {
            $('#inputIdICEdit').attr('value', data.id)
            $('#inputNameICEdit').attr('value', data.name)
            $('#inputURLICEdit').attr('value', data.url)
            $('#inputOrderingICEdit').attr('value', data.ordering)
            $('#inputIconICEdit').text(data.icon)
            $('#iconHolderICEdit').attr('src', data.icon)
            $('#updateInboxModal').modal('show')
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        console.log(jqXHR.responseJSON)
    })
}

function addInboxChannel() {
    if (!confirm('<?php echo lang('L_CONFIRM_ADD_INBOX_CHANNEL')?>')) {
        return;
    }
    $('#add_inbox_channel').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputNameICError').removeClass('border-danger')
    $('#inputNameICErrorText').text('')
    $('#inputURLICError').removeClass('border-danger')
    $('#inputURLICErrorText').text('')
    $('#inputOrderingICError').removeClass('border-danger')
    $('#inputOrderingICErrorText').text('')
    $('#inputIconICError').removeClass('border-danger')
    $('#inputIconICErrorText').text('')
    var data = {
        'name': $('#inputNameIC').val(),
        'url': $('#inputURLIC').val(),
        'ordering': $('#inputOrderingIC').val(),
        'icon': $('#inputIconIC').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/general_information/add_inbox_channel",
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
        $('#add_inbox_channel').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.icon != undefined) {
                    $('#inputIconICError').addClass('border-danger')
                    $('#inputIconICErrorText').text(jqXHR.responseJSON.errors.icon)
                }
                if (jqXHR.responseJSON.errors.ordering != undefined) {
                    $('#inputOrderingICError').addClass('border-danger')
                    $('#inputOrderingICErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.url != undefined) {
                    $('#inputURLICError').addClass('border-danger')
                    $('#inputURLICErrorText').text(jqXHR.responseJSON.errors.url)
                }
                if (jqXHR.responseJSON.errors.name != undefined) {
                    $('#inputNameICError').addClass('border-danger')
                    $('#inputNameICErrorText').text(jqXHR.responseJSON.errors.name)
                }
            }
        }
    })
}

function updateInboxChannel() {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_INBOX_CHANNEL')?>'
    if (!confirm(text.replace('%s', $('#inputNameICEdit').val()))) {
        return;
    }
    $('#update_inbox_channel').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleEditError').removeClass('border-danger')
    $('#inputTitleEditErrorText').text('')
    $('#inputSlugEditError').removeClass('border-danger')
    $('#inputSlugEditErrorText').text('')
    $('#inputOrderingEditError').removeClass('border-danger')
    $('#inputOrderingEditErrorText').text('')
    $('#inputBriefDescriptionEditError').removeClass('border-danger')
    $('#inputBriefDescriptionEditErrorText').text('')
    $('#inputFullDescriptionEditError').removeClass('border-danger')
    $('#inputFullDescriptionEditErrorText').text('')
    var data = {
        'id': $('#inputIdICEdit').val(),
        'name': $('#inputNameICEdit').val(),
        'url': $('#inputURLICEdit').val(),
        'ordering': $('#inputOrderingICEdit').val(),
        'icon': $('#inputIconICEdit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/general_information/update_inbox_channel",
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
        $('#update_inbox_channel').removeAttr("disabled")
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
            }
        }
    })
}

function updateOrderInboxChannel(id, name) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_INBOX_CHANNEL')?>'
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
        url: "/dashboard/general_information/update_inbox_channel_order",
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

function deleteInboxChannel(id, name) {
    var text = '<?php echo lang('L_CONFIRM_DELETE_INBOX_CHANNEL')?>'
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
        url: "/dashboard/general_information/delete_inbox_channel",
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
