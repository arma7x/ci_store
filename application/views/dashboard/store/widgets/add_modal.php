<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="modal fade col col-12 col-lg-10 offset-lg-2" id="addModal" tabindex="-1" style="z-index:999999;" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel"><?php echo lang('BTN_ADD_PRODUCT') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addForm">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputName" class="sr-only-rm"><?php echo lang('L_P_NAME');?></label>
                      <div id="inputNameError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe264;</i></span>
                        </div>
                        <input type="text" id="inputName" class="form-control" placeholder="<?php echo lang('L_P_NAME');?>" required>
                      </div>
                      <div id="inputNameErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputID" class="sr-only-rm"><?php echo lang('L_ID');?></label>
                              <div id="inputIDError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i id="add_mi" class="material-icons">&#xe866;</i></div>
                                </div>
                                <input type="text" id="inputID" class="form-control" placeholder="<?php echo lang('L_ID');?>" onInput="renderIcon('#inputID', '#add_mi')" required>
                              </div>
                              <div id="inputIDErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputSlug" class="sr-only-rm"><?php echo lang('L_P_SLUG');?></label>
                              <div id="inputSlugError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe165;</i></div>
                                </div>
                                <input type="text" id="inputSlug" class="form-control" placeholder="<?php echo lang('L_P_SLUG');?>" required>
                              </div>
                              <div id="inputSlugErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputPrice" class="sr-only-rm"><?php echo lang('L_P_PRICE');?></label>
                              <div id="inputPriceError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe227;</i></div>
                                </div>
                                <input type="number" id="inputPrice" class="form-control" placeholder="<?php echo lang('L_P_PRICE');?>" required>
                              </div>
                              <div id="inputPriceErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="row">
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputVisibility" class="sr-only-rm"><?php echo lang('L_P_VISIBILITY');?></label>
                              <div id="inputVisibilityError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
                                </div>
                                <select type="text" id="inputVisibility" class="form-control" placeholder="<?php echo lang('L_P_VISIBILITY');?>" required>
                                    <option value="1"><?php echo lang('L_P_VISIBILITY_SHOW');?></option>
                                    <option value="0"><?php echo lang('L_P_VISIBILITY_HIDE');?></option>
                                </select>
                              </div>
                              <div id="inputVisibilityErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputAvailability" class="sr-only-rm"><?php echo lang('L_P_AVAILABILITY');?></label>
                              <div id="inputAvailabilityError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe614;</i></div>
                                </div>
                                <select type="text" id="inputAvailability" class="form-control" placeholder="<?php echo lang('L_P_AVAILABILITY');?>" required>
                                    <option value="1"><?php echo lang('L_P_AVAILABILITY_TRUE');?></option>
                                    <option value="0"><?php echo lang('L_P_AVAILABILITY_FALSE');?></option>
                                </select>
                              </div>
                              <div id="inputAvailabilityErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-4">
                            <div class="form-group">
                              <label for="inputSpotlight" class="sr-only-rm"><?php echo lang('L_P_SPOTLIGHT');?></label>
                              <div id="inputSpotlightError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe838;</i></div>
                                </div>
                                <select type="text" id="inputSpotlight" class="form-control" required>
                                    <option value="0"><?php echo lang('L_P_SPOTLIGHT_NO');?></option>
                                    <option value="1"><?php echo lang('L_P_SPOTLIGHT_YES');?></option>
                                </select>
                              </div>
                              <div id="inputSpotlightErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                    <label for="inputCategory" class="sr-only-rm"><?php echo lang('H_CATEGORY');?></label>
                    <div class="clear-fix"></div>
                    <?php foreach($cat_list as $key => $value): ?>
                    <div class="form-check form-check-inline">
                      <input id="inputCategory" name="category" class="form-check-input" type="checkbox" value="<?php echo $value['id'] ?>">
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
                            <label for="inputPhotoMain" class="sr-only-rm"><?php echo lang('L_P_1_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputPhotoMainBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputPhotoMainBlob', null, 533, 533, 0.1, null, setPhotoPreview, '#mainPhotoPreview|#inputPhotoMain', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_1_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputPhotoMainError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputPhotoMain" class="form-control" placeholder="<?php echo lang('L_P_1_PHOTO_URL');?>" onInput="renderPreview('#inputPhotoMain', '#mainPhotoPreview')" required>
                              </div>
                            </div>
                            <div>
                                <img id="mainPhotoPreview" src="/static/img/android-chrome-192x192.png" class="d-block w-100">
                            </div>
                            <div id="inputPhotoMainErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputPhotoSecond" class="sr-only-rm"><?php echo lang('L_P_2_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputPhotoSecondBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputPhotoSecondBlob', null, 533, 533, 0.1, null, setPhotoPreview, '#secondPhotoPreview|#inputPhotoSecond', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_2_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputPhotoSecondError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputPhotoSecond" class="form-control" placeholder="<?php echo lang('L_P_2_PHOTO_URL');?>" required>
                              </div>
                            </div>
                            <div>
                                <img id="secondPhotoPreview" src="/static/img/android-chrome-192x192.png" class="d-block w-100">
                            </div>
                            <div id="inputPhotoSecondErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputPhotoThird" class="sr-only-rm"><?php echo lang('L_P_3_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputPhotoThirdBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputPhotoThirdBlob', null, 533, 533, 0.1, null, setPhotoPreview, '#thirdPhotoPreview|#inputPhotoThird', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_3_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputPhotoThirdError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputPhotoThird" class="form-control" placeholder="<?php echo lang('L_P_3_PHOTO_URL');?>" required>
                              </div>
                            </div>
                            <div>
                                <img id="thirdPhotoPreview" src="/static/img/android-chrome-192x192.png" class="d-block w-100">
                            </div>
                            <div id="inputPhotoThirdErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                        
                        <div class="col col-12 col-sm-3">
                            <label for="inputPhotoFourth" class="sr-only-rm"><?php echo lang('L_P_4_PHOTO');?></label>
                            <div class="custom-file">
                              <input id="inputPhotoFourthBlob" type="file" accept="image/*" class="custom-file-input" onChange="resizePicture('inputPhotoFourthBlob', null, 533, 533, 0.1, null, setPhotoPreview, '#fourthPhotoPreview|#inputPhotoFourth', uploadPhoto)"/>
                              <label class="custom-file-label"><?php echo lang('L_P_4_PHOTO') ;?></label>
                            </div>
                            <div class="text-center"><?php echo lang('L_P_OR_PHOTO');?></div>
                            <div class="form-group">
                              <div id="inputPhotoFourthError" class="input-group border rounded">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">&#xe439;</i></div>
                                </div>
                                <input type="text" id="inputPhotoFourth" class="form-control" placeholder="<?php echo lang('L_P_4_PHOTO_URL');?>" required>
                              </div>
                              <div id="inputPhotoFourthErrorText" class="form-control-feedback text-danger"></div>
                            </div>
                            <div>
                                <img id="fourthPhotoPreview" src="/static/img/android-chrome-192x192.png" class="d-block w-100">
                            </div>
                            <div id="inputPhotoFourthErrorText" class="form-control-feedback text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                      <label for="inputBriefDescription" class="sr-only-rm"><?php echo lang('L_E_BRIEF_DESC');?></label>
                      <div id="inputBriefDescriptionError" class="input-group border rounded">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe261;</i></span>
                        </div>
                        <textarea rows="4" type="email" id="inputBriefDescription" class="form-control" placeholder="<?php echo lang('L_E_BRIEF_DESC');?>" required></textarea>
                      </div>
                      <div id="inputBriefDescriptionErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputFullDescription" class="sr-only-rm"><?php echo lang('L_E_FULL_DESC');?></label>
                      <div id="inputFullDescriptionError" class="input-group-sr border-sr rounded-sr">
                        <!--
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="material-icons">&#xe3c7;</i></span>
                        </div>
                        -->
                        <textarea rows="4" type="text" id="inputFullDescription" class="form-control" placeholder="<?php echo lang('L_E_FULL_DESC');?>" required></textarea>
                      </div>
                      <div id="inputFullDescriptionErrorText" class="form-control-feedback text-danger"></div>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button id="add_product" type="button" class="btn btn-primary" onclick="addProduct()"><?php echo lang('BTN_ADD_PRODUCT') ?></button>
      </div>
      <script>
          $('#inputFullDescription').trumbowyg({semantic: false});
          $('#addModal').on('hidden.bs.modal', function (e) {
              // $('#addForm').trigger('reset')
          })
      </script>
    </div>
  </div>
</div>
