<form class="forms-sample" method="post" action="{base_url}manage/sections/filters_sort/<?=$item['filter_id'];?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-danger border-danger" id="sort">
                              <i class="fa fa-sort-amount-asc text-white"></i>
                            </span>
                          </div>
                          <input type="number" min="0" name="sort" class="form-control" placeholder="Tartib" aria-label="tartib" aria-describedby="sort" value="<?=$item['sort']?>">
                          <div class="input-group-append">
                            <span class="input-group-text bg-dark border-dark pointer math-minus" data-input="[type='number']"><i class="fa fa-minus text-white"></i></span>                            
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text bg-dark border-dark pointer math-plus" data-input="[type='number']"><i class="fa fa-plus text-white"></i></span>                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Saqlash</button>
                    <a href="#" rel="modal:close"><button type="button" class="btn btn-light">Bekor qilish</button></a>
                  </form>