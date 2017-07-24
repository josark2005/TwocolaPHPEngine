function create_app(){
  var app = $("#APP").val();
  var result = generate_app(app);
  if( result == true ){
    $("#APP").val("");
  }
}
