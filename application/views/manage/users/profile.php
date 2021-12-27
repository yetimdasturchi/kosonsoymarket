<form class="forms-sample" method="post" action="{base_url}manage/users/update/<?=$item['user_id']?>" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="password">Yangi parol</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Parol...">
                      </div>
                      <div class="form-group col-md-12 col-sm-12 col-lg-12">
                        <label for="fullname">To'liq ism</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="To'liq ism..." required="" value="<?=$item['fullname']?>">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2 col-md-12 col-sm-12 col-lg-12">Saqlash</button>
                  </form>