<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="updateModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="updateModalName" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalName"><?php echo lang('BTN_UPDATE_PRODUCT') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputNameEdit" class="sr-only-rm"><?php echo lang('L_P_NAME');?></label>
                      <div id="inputNameEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                        </div>
                        <input type="text" id="inputNameEdit" class="form-control" placeholder="<?php echo lang('L_P_NAME');?>" required>
                      </div>
                      <div id="inputNameEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputIDEdit" class="sr-only-rm"><?php echo lang('L_ID');?></label>
                              <div id="inputIDEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i id="add_mi" class="material-icons">&#xe866;</i></div>
                                </div>
                                <input type="text" id="inputIDEdit" class="form-control" placeholder="<?php echo lang('L_ID');?>" readonly required>
                              </div>
                              <div id="inputIDEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputSlugEdit" class="sr-only-rm"><?php echo lang('L_P_SLUG');?></label>
                              <div id="inputSlugEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe165;</i></div>
                                </div>
                                <input type="text" id="inputSlugEdit" class="form-control" placeholder="<?php echo lang('L_P_SLUG');?>" readonly required>
                              </div>
                              <div id="inputSlugEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputPriceEdit" class="sr-only-rm"><?php echo lang('L_P_PRICE');?></label>
                              <div id="inputPriceEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe227;</i></div>
                                </div>
                                <input type="number" id="inputPriceEdit" class="form-control" placeholder="<?php echo lang('L_P_PRICE');?>" required>
                              </div>
                              <div id="inputPriceEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputVisibilityEdit" class="sr-only-rm"><?php echo lang('L_P_VISIBILITY');?></label>
                              <div id="inputVisibilityEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
                                </div>
                                <select type="text" id="inputVisibilityEdit" class="form-control" placeholder="<?php echo lang('L_P_VISIBILITY');?>" required>
                                    <option value="1"><?php echo lang('L_P_VISIBILITY_SHOW');?></option>
                                    <option value="0"><?php echo lang('L_P_VISIBILITY_HIDE');?></option>
                                </select>
                              </div>
                              <div id="inputVisibilityEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputAvailabilityEdit" class="sr-only-rm"><?php echo lang('L_P_AVAILABILITY');?></label>
                              <div id="inputAvailabilityEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe614;</i></div>
                                </div>
                                <select type="text" id="inputAvailabilityEdit" class="form-control" placeholder="<?php echo lang('L_P_AVAILABILITY');?>" required>
                                    <option value="1"><?php echo lang('L_P_AVAILABILITY_TRUE');?></option>
                                    <option value="0"><?php echo lang('L_P_AVAILABILITY_FALSE');?></option>
                                </select>
                              </div>
                              <div id="inputAvailabilityEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputSpotlightEdit" class="sr-only-rm"><?php echo lang('L_P_SPOTLIGHT');?></label>
                              <div id="inputSpotlightEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe89a;</i></div>
                                </div>
                                <select type="text" id="inputSpotlightEdit" class="form-control" required>
                                    <option value="0"><?php echo lang('L_P_SPOTLIGHT_NO');?></option>
                                    <option value="1"><?php echo lang('L_P_SPOTLIGHT_YES');?></option>
                                </select>
                              </div>
                              <div id="inputSpotlightEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                    <label for="inputCategoryEdit" class="sr-only-rm"><i class="material-icons">&#xe54e;</i> <?php echo lang('H_CATEGORY');?></label>
                    <div class="clear-fix"></div>
                    <?php foreach($cat_list as $key => $value): ?>
                    <div class="form-check form-check-inline">
                      <input id="inputCategoryEdit" name="categoryEdit" class="form-check-input" type="checkbox" value="<?php echo $value['id'] ?>">
                      <label class="form-check-label" for="category">
                        <?php echo $value['name'] ?>
                      </label>
                    </div>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="col col-12 mb-2">
                    <div class="row">
                        <div class="col col-12 col-sm-3">
                            <label for="inputMainPhotoEdit" class="sr-only-rm"><?php echo lang('L_P_1_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputMainPhotoEditBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputMainPhotoEditBlob', 2, 0, 0, 0.1, null, setPhotoPreview, '#mainPhotoPreviewEdit|#inputMainPhotoEdit', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_1_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputMainPhotoEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputMainPhotoEdit" class="form-control" placeholder="<?php echo lang('L_P_1_PHOTO_URL');?>" onInput="renderPreview('#inputMainPhotoEdit', '#mainPhotoPreviewEdit')" required>
                              </div>
                            </div>
                            <div>
                                <img id="mainPhotoPreviewEdit" src="" class="d-block w-100">
                            </div>
                            <div id="inputMainPhotoEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputSecondPhotoEdit" class="sr-only-rm"><?php echo lang('L_P_2_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputSecondPhotoEditBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputSecondPhotoEditBlob', 2, 0, 0, 0.1, null, setPhotoPreview, '#secondPhotoPreviewEdit|#inputSecondPhotoEdit', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_2_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputSecondPhotoEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputSecondPhotoEdit" class="form-control" placeholder="<?php echo lang('L_P_2_PHOTO_URL');?>" onInput="renderPreview('#inputSecondPhotoEdit', '#secondPhotoPreviewEdit')" required>
                              </div>
                            </div>
                            <div>
                                <img id="secondPhotoPreviewEdit" src="" class="d-block w-100">
                            </div>
                            <div id="inputSecondPhotoEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputThirdPhotoEdit" class="sr-only-rm"><?php echo lang('L_P_3_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputThirdPhotoEditBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputThirdPhotoEditBlob', 2, 0, 0, 0.1, null, setPhotoPreview, '#thirdPhotoPreviewEdit|#inputThirdPhotoEdit', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_3_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputThirdPhotoEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputThirdPhotoEdit" class="form-control" placeholder="<?php echo lang('L_P_3_PHOTO_URL');?>" onInput="renderPreview('#inputThirdPhotoEdit', '#thirdPhotoPreviewEdit')" required>
                              </div>
                            </div>
                            <div>
                                <img id="thirdPhotoPreviewEdit" src="" class="d-block w-100">
                            </div>
                            <div id="inputThirdPhotoEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputFourthPhotoEdit" class="sr-only-rm"><?php echo lang('L_P_4_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputFourthPhotoEditBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputFourthPhotoEditBlob', 2, 0, 0, 0.1, null, setPhotoPreview, '#fourthPhotoPreviewEdit|#inputFourthPhotoEdit', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_4_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputFourthPhotoEditError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputFourthPhotoEdit" class="form-control" placeholder="<?php echo lang('L_P_4_PHOTO_URL');?>" onInput="renderPreview('#inputFourthPhotoEdit', '#fourthPhotoPreviewEdit')" required>
                              </div>
                              <div id="inputFourthPhotoEditErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                            <div>
                                <img id="fourthPhotoPreviewEdit" src="" class="d-block w-100">
                            </div>
                            <div id="inputFourthPhotoEditErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputBriefDescriptionEdit" class="sr-only-rm">
                          <?php echo lang('L_E_BRIEF_DESC');?>
                          <small><span id="inputBriefDescriptionEditLength">0</span>/160</small>
                      </label>
                      <div id="inputBriefDescriptionEditError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe261;</i></span>
                        </div>
                        <textarea rows="4" type="email" id="inputBriefDescriptionEdit" class="form-control" placeholder="<?php echo lang('L_E_BRIEF_DESC');?>" onInput="checkLength('#inputBriefDescriptionEdit', '#inputBriefDescriptionEditLength')" maxlength="160" required></textarea>
                      </div>
                      <div id="inputBriefDescriptionEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputFullDescriptionEdit" class="sr-only-rm"><?php echo lang('L_E_FULL_DESC');?></label>
                      <div id="inputFullDescriptionEditError" class="input-group-sr border-sr rounded-sr">
                        <!--
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe3c7;</i></span>
                        </div>
                        -->
                        <textarea rows="4" type="text" id="inputFullDescriptionEdit" class="form-control" placeholder="<?php echo lang('L_E_FULL_DESC');?>" required></textarea>
                      </div>
                      <div id="inputFullDescriptionEditErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button id="update_product" type="button" class="btn btn-primary" onclick="updateProduct()">
            <?php echo lang('BTN_UPDATE_PRODUCT') ?>
        </button>
      </div>
      <script>
          $('#inputFullDescriptionEdit').trumbowyg({semantic: false});
          $('#updateModal').on('hidden.bs.modal', function (e) {
            for(var y in $("input[name='categoryEdit']")) {
                $("input[name='categoryEdit']")[y].checked = false
            }
          })
      </script>
    </div>
  </div>
</div>
