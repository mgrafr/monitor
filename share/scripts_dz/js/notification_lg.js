const superagent = require('superagent');
var texte = process.argv[2]; //texte à afficher
var idxdz = process.argv[3];//variable dz
var vnamedz = process.argv[4];//variable dz
var vtypedz = process.argv[5];//variable dz
var vvaluedz = process.argv[6];//variable dz
var tvip = process.argv[7];//ip télé
var ip_port_dz = process.argv[8];//ip port dz
//console.log(texte);
lgtv = require("lgtv");
var tv_ip_address = tvip;
lgtv.connect(tv_ip_address, function(err, response){
  if (!err) {console.log('qqq:'+response);
    lgtv.show_float(texte, function(err, response){
		if (!err) {
        lgtv.disconnect();
		superagent
  .get('http://'+ip_port_dz+'/json.htm')
  .query({ type:'command', param:'updateuservariable', idx:idxdz, vname:vnamedz,vtype:vtypedz ,vvalue:vvaluedz }) // sends a JSON post body
  .set('accept', 'json')
  .end((err, res) => { return console.log(err); 
  console.log(res.body.url);
  console.log(res.body.explanation);}
				)}
		else {lgtv.disconnect(); }
 })	;	
}
}); // connect