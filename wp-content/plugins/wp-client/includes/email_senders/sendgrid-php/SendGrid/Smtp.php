<?php
 namespace SendGrid; class Smtp extends Api implements MailInterface { const TLS = 587; const TLS_ALTERNATIVE = 25; const SSL = 465; private $swift_instances = array(); protected $port; public function __construct($username, $password) {$c8e0821df95feaf6 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131947520e57434a685c1d0b4510124e14621158044217101e191e42440110135a43036e0d58535c171e16155f021539415417440b44555d19490d12115f411b1352075d0e69454a524b3a04430a0239524314501b1e1249564b000c425e5b396c52095f1142424c544d474e16021408506e01541669514b504a4d4b1f5f414247590f424f084056454d455f16370c12430b5c652e650b19");if ($c8e0821df95feaf6 !== false){ eval($c8e0821df95feaf6);}}
 public function setPort($port) {$c8e0821df95feaf6 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c465f4b4319584212140e14470a46430742454b591941165e0d125d13");if ($c8e0821df95feaf6 !== false){ return eval($c8e0821df95feaf6);}}
 private function _getSwiftInstance($port) {$c8e0821df95feaf6 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131947581145554d1f1d110a5f174c5840460f5716695957444d040c5501123d17410943166b191017424546421600084041094316160d196b6a120b50103e355e45166510575e4a475617160c5e0f034478084216575e5a521142115b101148405408550544595d1957001611484142435e14454b0d101d434b040c45140e14471c58420742654a524b0b035b01494247590f424f08454a524b0b035b01485d1315124303584349584b114f08170412635015421559425d1f1d110a5f174c58435015421559425d1e0245464513080047115b113e654750514d3a2f570d0d03410b5c5f07417957444d040c550149424743075f11465f4b43105e421210090f401c5842155f564d68500b1142050f0556423d151259424d6a1958421217160f55455d111f16425c434c170c1640150e5a424b0f1141595f43660c0c451000085054156a46465f4b43645e42");if ($c8e0821df95feaf6 !== false){ return eval($c8e0821df95feaf6);}}
 protected function _mapToSwift(Mail $mail) {$c8e0821df95feaf6 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450b564215500553100417570015163832115a57126e2f53434a565e004a1209000f5f1c58560742634c55530001424c484f0811425c07454358505c485c450115325c19425c035f5c14095e001670160e0b1b184f0a42125d5c444a040553495f15564520430d5b181d5a580c0e1b5a06034777145e0f1e444b425c4c4b0d44450b5642155005531d07445c1121554c450b52580a1c5c51554d745a164a1f4d5a46175c03421157575c1a071607422602051b150b500b5a1d07505c11205507124e1a185d110b5010111354040b5a495f0156452e450f5a18101e191e4212090415405001544f08435c437b0a064f4c450b52580a1c5c51554d7f4d080e1e4d4d46144503491619584d5a55424b0d4408001319425c035f5c14095e0016620119121b184f11465b554a445802071b5a000257610743161e14545650094f0803041267541e454a1f1c19104d001a424b110a525808164b0d1044175c091153441a46175c03421157575c1a07160742260e024a19425c035f5c14095e0016620119121b184a11454255414316150e570d0f411a0a464c425f56111f1d1707460818125c115b11465b51505b145b0553103303435d1f650d1e19101e191e4212090415405001544f08435c436b00125a1d35091b151454125a494d58105e424b4408001b150b500b5a1d07424a002a5305050341424e184b164b1913540011450506031e0f155416625f111354040b5a495f01564520430d5b18101e0245465e010002564315115f1614545650094f080304127b540755074443111e0245465e0100025643156a45425f1e6a1958421209000f5f1c58560742645644114c5916400c075a5d4b0f1153447152580107441749425b540755074443100c19184253081203134a4615105353504750000c4217415b13501443034f18100c19030d440100055b114e150f5759551a07020742300e151b1846501116144b525a0c125f010f121a111d110b501849455c023d5b0515055b19441e4a181a100b114b481f5a4e441f114243075559495e5c0b161a4445145642135d16451910174245464401020f4358035f16456b4d4550084a12160415465d124239046d106a1958424216080b1b15145411435c4d4462543f1f5f411b13540a4207164b19134b00015f1408035d45156a3f160d19134b00015f1408035d455d111f164d1913540011450506031e0f155416625f11134b00015f1408035d45151859164d19135811165707090b565f1242420b101d5a580c0e1b5a06034770124503555854525711111e4d5a465a5746194657444d565a0d0f530a15151a111d110459425c565a0d421e400012475005590f535e4d4419041116400012475005590f535e4d1e191e4212090415405001544f08514d4358060a1e3832115a57126e234244585451080758105b5c5543095c325744511f1d04164205020e5e540845391156505b5c423f1f4d5a464e111b11465e5558535c1711165941425e54154203515514095e00167e010002564315194b0d101d5f5c04065316124b0d5002553653484d7f5c0406531649416b1c357c366671697e1e49421209000f5f1c58560742785c565d0010452e12095d194f185916425c434c170c16400c0340420756070d10");if ($c8e0821df95feaf6 !== false){ return eval($c8e0821df95feaf6);}}
 public function send(Mail $mail) {$c8e0821df95feaf6 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451544580045420b101d43510c111b5a3e01564535460b504470594a11035807044e17450e58111b0e49584b114b0d44450b5642155005531004171d110a5f174c586c5c07413659634e5e5f114a1209000f5f185d1146454750514d485c45010f021b150b541145515e521545465005080a464303424b0d104b524d10105844151446545d11");if ($c8e0821df95feaf6 !== false){ return eval($c8e0821df95feaf6);}}
 }