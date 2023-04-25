$(function(){
	//利用登録のheader用
	if($("#content").hasClass("guide")){
		var applay ='';
		var	needs ='';
		var about = '';

		$("#nav li#guide").addClass("active");
		if($("#content").hasClass("apply")){
			applay = 'class="active"';
		}else if($("#content").hasClass("needs")){
			needs = 'class="active"';
		}else{
			about = 'class="active"';
		}
		
		var cord =
			'<div id="lnav">' +
			'<ul>' +
			'<li ' + about  + '><a href="/dtox/guide">除染・中間貯蔵関連技術探索サイトとは</a></li>' +
			'<li ' + applay + '><a href="/dtox/guide/tech">技術の登録申請</a></li>' +
			'</ul>' +
			'</div><!-- end.div nav -->';

		$("div#header").append(cord);
	}

	//関連情報のheader用
	if($("#content").hasClass("info")){
		var materials = '';
		var proof = '';
		var index = '';

		$("#nav li#info").addClass("active");

		if($("#content").hasClass("materials")){
			materials = 'class="active"';
		}else if($("#content").hasClass("proof")){
			proof = 'class="active"';
		}else{
			index = 'class="active"';
		}
		
		var cord =
			'<div id="lnav">' +
			'<ul>' +
			'<li ' + index  + '><a href="/dtox/info">イベント・プレスリリース等</a></li>' +
			'<li ' + proof  + '><a href="/dtox/info/proof">除去土壌等の減容等技術実証事業</a></li>' +
			'<li ' + materials + '><a href="/dtox/info/material">政策資料・ガイドライン</a></li>' +
			'</ul>' +
			'</div><!-- end.div nav -->';

		$("div#header").append(cord);
	}

	//リンク集のheader用
	if($("#content").hasClass("link")){
		$("#nav li#link").addClass("active");
	}

	//会員向けページのheader用
	if($("#content").hasClass("memberpage")){
		$("#nav li#member").addClass("active");
		if($("#content").hasClass("tech")){
			var tech = 'class="active"';
		}
		
		var cord =
			'<div id="lnav">' +
			'<ul>' +
			'<li><a href="#">トップ</a></li>' +
			'<li ' + tech + '><a href="#">技術検索</a></li>' +
			'<li><a href="#">技術受付ポスト</a></li>' +
			'<!--<li><a href="#">課題検索</a></li>-->' +
			'<!--<li><a href="#">課題受付ポスト</a></li>-->' +
			'</ul>' +
			'</div><!-- end.div nav -->';

		$("div#header").append(cord);
	}

	//サイトマップのheader用
	if($("#content").hasClass("sitemap")){
		$("#nav li#link").addClass("active");
	
	}

});