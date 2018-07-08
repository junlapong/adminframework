function initDemoForm() {
  $G("range1").addEvent("input", function() {
    $E("register_amount").value = this.value;
  });
  $G("register_amount").addEvent("change", function() {
    $E("range1").setValue(this.value);
  });
  $G("range1").addEvent("change", function() {
    document.title = this.value;
  });
  $G("range2").addEvent("input", function() {
    $E("register_phone").value = this.value;
  });
}
function initProvince() {
  new GMultiSelect(["provinceID", "amphurID", "districtID"], {
    action: WEB_URL + "index.php/demo/model/province/get"
  });
}
function initDemoAutocomplete() {
  var o = {
    callBack: function() {
      $G("search_districtID").valid().value = this.district;
      $G("search_amphurID").valid().value = this.amphur;
      $G("search_provinceID").valid().value = this.province;
      $E("districtID").value = this.districtID;
      $E("amphurID").value = this.amphurID;
      $E("provinceID").value = this.provinceID;
    },
    onChanged: function() {
      $G("search_districtID").reset();
      $G("search_amphurID").reset();
      $G("search_provinceID").reset();
      $E("districtID").value = 0;
      $E("amphurID").value = 0;
      $E("provinceID").value = 0;
    }
  };
  initAutoComplete(
    "search_districtID",
    WEB_URL + "index.php/demo/model/autocomplete/district",
    "district,amphur,province",
    "location",
    o
  );
  initAutoComplete(
    "search_amphurID",
    WEB_URL + "index.php/demo/model/autocomplete/amphur",
    "district,amphur,province",
    "location",
    o
  );
  initAutoComplete(
    "search_provinceID",
    WEB_URL + "index.php/demo/model/autocomplete/province",
    "district,amphur,province",
    "location",
    o
  );
}
