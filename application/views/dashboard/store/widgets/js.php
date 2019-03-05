<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>

function renderIcon(src, holder) {
    $(holder).html($(src).val()).text()
}

function findProduct(id) {
    var request = $.ajax({
        url: "/dashboard/store/find",
        method: "GET",
        data: {
            'id': id
        }
    })
    request.done(function(data) {
        loadingSpinner(false)
        if (data.product != undefined) {
            $('#inputIDEdit').attr('value', data.product.id)
            $('#inputNameEdit').attr('value', data.product.name)
            $('#inputSlugEdit').attr('value', data.product.slug)
            $('#inputPriceEdit').attr('value', data.product.price)
            $('#inputMainPhotoEdit').attr('value', data.product.main_photo)
            renderPreview('#inputMainPhotoEdit', '#mainPhotoPreviewEdit')
            $('#inputSecondPhotoEdit').attr('value', data.product.second_photo)
            renderPreview('#inputSecondPhotoEdit', '#secondPhotoPreviewEdit')
            $('#inputThirdPhotoEdit').attr('value', data.product.third_photo)
            renderPreview('#inputThirdPhotoEdit', '#thirdPhotoPreviewEdit')
            $('#inputFourthPhotoEdit').attr('value', data.product.fourth_photo)
            renderPreview('#inputFourthPhotoEdit', '#fourthPhotoPreviewEdit')
            $('#inputVisibilityEdit option[value='+data.product.visibility+']').attr('selected','selected');
            $('#inputAvailabilityEdit option[value='+data.product.availability+']').attr('selected','selected');
            $('#inputSpotlightEdit option[value='+data.product.spotlight+']').attr('selected','selected');
            for(var x in data.category) {
                for(var y in $("input[name='categoryEdit']")) {
                    if ($("input[name='categoryEdit']")[y].value == data.category[x].id) {
                        $("input[name='categoryEdit']")[y].checked = true
                    } else {
                        //$("input[name='categoryEdit']")[y].checked = false
                    }
                }
            }
            $('#inputBriefDescriptionEdit').text(data.product.brief_description)
            $('#inputFullDescriptionEdit').trumbowyg('html', data.product.full_description);
            $('#updateModal').modal('show')
        }
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        console.log(jqXHR.responseJSON)
    })
}

function renderPreview(src, holder) {
    $(holder).attr('src', $(src).val())
}

function setPhotoPreview(data, selector) {
    var selectors = selector.split('|')
    $(selectors[0]).attr('src', data)
}

function uploadPhoto(photo, selector) {
    var selectors = selector.split('|')
    loadingSpinner(true)

    var data = new FormData()
    data.append('photo', photo, Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 10)+'.'+photo.type.split('/')[1])
    data.append(window.csrf_token_name, window.csrf_hash)

    var request = $.ajax({
        url: "/dashboard/store/upload",
        method: "POST",
        data: data,
        contentType: false,
        processData: false,
    })
    request.done(function(data) {
        loadingSpinner(false)
        $(selectors[1]).val('/static/img/product/'+data.client_name)
        $(selectors[0]).attr('src', '/static/img/product/'+data.client_name)
    })
    request.fail(function(jqXHR) {
        loadingSpinner(false)
        $('#add_product').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.error != undefined) {
                showDangerMessage(jqXHR.responseJSON.error)
            }
        }
    })
}

function addProduct() {
    if (!confirm('<?php echo lang('L_CONFIRM_ADD_PRODUCT')?>')) {
        return;
    }
    $('#add_product').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputIDError').removeClass('border-danger')
    $('#inputIDErrorText').text('')
    $('#inputNameError').removeClass('border-danger')
    $('#inputNameErrorText').text('')
    $('#inputSlugError').removeClass('border-danger')
    $('#inputSlugErrorText').text('')
    $('#inputPriceError').removeClass('border-danger')
    $('#inputPriceErrorText').text('')
    $('#inputVisibilityError').removeClass('border-danger')
    $('#inputVisibilityErrorText').text('')
    $('#inputSpotlightError').removeClass('border-danger')
    $('#inputSpotlightErrorText').text('')
    $('#inputAvailabilityError').removeClass('border-danger')
    $('#inputAvailabilityErrorText').text('')
    $('#inputMainPhotoError').removeClass('border-danger')
    $('#inputMainPhotoErrorText').text('')
    $('#inputSecondPhotoError').removeClass('border-danger')
    $('#inputSecondPhotoErrorText').text('')
    $('#inputThirdPhotoError').removeClass('border-danger')
    $('#inputThirdPhotoErrorText').text('')
    $('#inputFourthPhotoError').removeClass('border-danger')
    $('#inputFourthPhotoErrorText').text('')
    $('#inputBriefDescriptionError').removeClass('border-danger')
    $('#inputBriefDescriptionErrorText').text('')
    $('#inputFullDescriptionError').removeClass('border-danger')
    $('#inputFullDescriptionErrorText').text('')

    var data = {
        'id': $('#inputID').val(),
        'name': $('#inputName').val(),
        'slug': $('#inputSlug').val(),
        'price': $('#inputPrice').val(),
        'visibility': $('#inputVisibility').val(),
        'spotlight': $('#inputSpotlight').val(),
        'availability': $('#inputAvailability').val(),
        'category': $("input[name='category']").serialize(),
        'main_photo': $('#inputMainPhoto').val(),
        'second_photo': $('#inputSecondPhoto').val(),
        'third_photo': $('#inputThirdPhoto').val(),
        'fourth_photo': $('#inputFourthPhoto').val(),
        'brief_description': $('#inputBriefDescription').val(),
        'full_description': $('#inputFullDescription').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/store/add",
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
        $('#add_product').removeAttr("disabled")
        if (jqXHR.responseJSON != undefined) {
            if (jqXHR.responseJSON.message != undefined) {
                showDangerMessage(jqXHR.responseJSON.message)
            }
            if (jqXHR.responseJSON.errors != undefined) {
                if (jqXHR.responseJSON.errors.id != undefined) {
                    $('#inputIDError').addClass('border-danger')
                    $('#inputIDErrorText').text(jqXHR.responseJSON.errors.id)
                }
                if (jqXHR.responseJSON.errors.name != undefined) {
                    $('#inputNameError').addClass('border-danger')
                    $('#inputNameErrorText').text(jqXHR.responseJSON.errors.name)
                }
                if (jqXHR.responseJSON.errors.slug != undefined) {
                    $('#inputSlugError').addClass('border-danger')
                    $('#inputSlugErrorText').text(jqXHR.responseJSON.errors.slug)
                }
                if (jqXHR.responseJSON.errors.price != undefined) {
                    $('#inputPriceError').addClass('border-danger')
                    $('#inputPriceErrorText').text(jqXHR.responseJSON.errors.price)
                }
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityError').addClass('border-danger')
                    $('#inputVisibilityErrorText').text(jqXHR.responseJSON.errors.visibility)
                }
                if (jqXHR.responseJSON.errors.spotlight != undefined) {
                    $('#inputSpotlightError').addClass('border-danger')
                    $('#inputSpotlightErrorText').text(jqXHR.responseJSON.errors.spotlight)
                }
                if (jqXHR.responseJSON.errors.availability != undefined) {
                    $('#inputAvailabilityError').addClass('border-danger')
                    $('#inputAvailabilityErrorText').text(jqXHR.responseJSON.errors.availability)
                }
                if (jqXHR.responseJSON.errors.main_photo != undefined) {
                    $('#inputMainPhotoError').addClass('border-danger')
                    $('#inputMainPhotoErrorText').text(jqXHR.responseJSON.errors.main_photo)
                }
                if (jqXHR.responseJSON.errors.second_photo != undefined) {
                    $('#inputSecondPhotoError').addClass('border-danger')
                    $('#inputSecondPhotoErrorText').text(jqXHR.responseJSON.errors.second_photo)
                }
                if (jqXHR.responseJSON.errors.third_photo != undefined) {
                    $('#inputThirdPhotoError').addClass('border-danger')
                    $('#inputThirdPhotoErrorText').text(jqXHR.responseJSON.errors.third_photo)
                }
                if (jqXHR.responseJSON.errors.fourth_photo != undefined) {
                    $('#inputFourthPhotoError').addClass('border-danger')
                    $('#inputFourthPhotoErrorText').text(jqXHR.responseJSON.errors.fourth_photo)
                }
                if (jqXHR.responseJSON.errors.brief_description != undefined) {
                    $('#inputBriefDescriptionError').addClass('border-danger')
                    $('#inputBriefDescriptionErrorText').text(jqXHR.responseJSON.errors.brief_description)
                }
                if (jqXHR.responseJSON.errors.full_description != undefined) {
                    $('#inputFullDescriptionError').addClass('border-danger')
                    $('#inputFullDescriptionErrorText').text(jqXHR.responseJSON.errors.full_description)
                }
            }
        }
    })
}

function updateEI() {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_PRODUCT')?>'
    if (!confirm(text.replace('%s', $('#inputTitleEdit').val()))) {
        return;
    }
    $('#update_product').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputTitleEditError').removeClass('border-danger')
    $('#inputTitleEditErrorText').text('')
    $('#inputNameEditError').removeClass('border-danger')
    $('#inputNameEditErrorText').text('')
    $('#inputSlugEditError').removeClass('border-danger')
    $('#inputSlugEditErrorText').text('')
    $('#inputPriceEditError').removeClass('border-danger')
    $('#inputPriceEditErrorText').text('')
    $('#inputVisibilityEditError').removeClass('border-danger')
    $('#inputVisibilityEditErrorText').text('')
    $('#inputSpotlightEditError').removeClass('border-danger')
    $('#inputSpotlightEditErrorText').text('')
    $('#inputBriefDescriptionEditError').removeClass('border-danger')
    $('#inputBriefDescriptionEditErrorText').text('')
    $('#inputFullDescriptionEditError').removeClass('border-danger')
    $('#inputFullDescriptionEditErrorText').text('')
    var data = {
        'id': $('#inputIdEdit').val(),
        'title': $('#inputTitleEdit').val(),
        'slug': $('#inputNameEdit').val(),
        'ordering': $('#inputSlugEdit').val(),
        'position': $('#inputPriceEdit').val(),
        'visibility': $('#inputVisibilityEdit').val(),
        'material_icon': $('#inputSpotlightEdit').val(),
        'brief_description': $('#inputBriefDescriptionEdit').val(),
        'full_description': $('#inputFullDescriptionEdit').val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/store/update",
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
        $('#update_product').removeAttr("disabled")
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
                    $('#inputSlugEditError').addClass('border-danger')
                    $('#inputSlugEditErrorText').text(jqXHR.responseJSON.errors.ordering)
                }
                if (jqXHR.responseJSON.errors.slug != undefined) {
                    $('#inputNameEditError').addClass('border-danger')
                    $('#inputNameEditErrorText').text(jqXHR.responseJSON.errors.slug)
                }
                if (jqXHR.responseJSON.errors.title != undefined) {
                    $('#inputTitleEditError').addClass('border-danger')
                    $('#inputTitleEditErrorText').text(jqXHR.responseJSON.errors.title)
                }
                if (jqXHR.responseJSON.errors.position != undefined) {
                    $('#inputPriceEditError').addClass('border-danger')
                    $('#inputPriceEditErrorText').text(jqXHR.responseJSON.errors.position)
                }
                if (jqXHR.responseJSON.errors.visibility != undefined) {
                    $('#inputVisibilityEditError').addClass('border-danger')
                    $('#inputVisibilityEditErrorText').text(jqXHR.responseJSON.errors.visibility)
                }
                if (jqXHR.responseJSON.errors.material_icon != undefined) {
                    $('#inputSpotlightEditError').addClass('border-danger')
                    $('#inputSpotlightEditErrorText').text(jqXHR.responseJSON.errors.material_icon)
                }
            }
        }
    })
}

function updateOrderEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_PRODUCT')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputSlug'+id).removeClass('border-danger')
    $('#inputSlugErrorText'+id).text('')
    var data = {
        'id': id,
        'ordering': $('#inputSlug'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/store/update_order",
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
                    $('#inputSlugError'+id).addClass('border-danger')
                    $('#inputSlugErrorText'+id).text(jqXHR.responseJSON.errors.ordering)
                }
            }
        }
    })
}

function updatePositionEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_PRODUCT')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputPrice'+id).removeClass('border-danger')
    $('#inputPriceErrorText'+id).text('')
    var data = {
        'id': id,
        'position': $('#inputPrice'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/store/update_position",
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
                    $('#inputPriceError'+id).addClass('border-danger')
                    $('#inputPriceErrorText'+id).text(jqXHR.responseJSON.errors.position)
                }
            }
        }
    })
}

function updateVisibilityEI(id, title) {
    var text = '<?php echo lang('L_CONFIRM_UPDATE_PRODUCT')?>'
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
        url: "/dashboard/store/update_visibility",
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
    var text = '<?php echo lang('L_CONFIRM_UPDATE_PRODUCT')?>'
    if (!confirm(text.replace('%s', title))) {
        return;
    }
    $('button').attr("disabled", "disabled")
    hideDangerMessage()
    $('#inputSpotlight'+id).removeClass('border-danger')
    $('#inputSpotlightErrorText'+id).text('')
    var data = {
        'id': id,
        'material_icon': $('#inputSpotlight'+id).val(),
    }
    data[window.csrf_token_name] = window.csrf_hash
    var request = $.ajax({
        url: "/dashboard/store/update_icon",
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
                    $('#inputSpotlightError'+id).addClass('border-danger')
                    $('#inputSpotlightErrorText'+id).text(jqXHR.responseJSON.errors.material_icon)
                }
            }
        }
    })
}

function deleteProduct(id, title) {
    var text = '<?php echo lang('L_CONFIRM_DELETE_PRODUCT')?>'
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
        url: "/dashboard/store/delete",
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
