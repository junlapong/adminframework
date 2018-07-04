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
