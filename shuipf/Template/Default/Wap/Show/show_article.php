<template file="Wap/header.php"/>	
    <link rel="stylesheet" href="{:C('wap_ui')}css/article_detail.css">
	</head>
	<body>
<div class="wrapper">
      <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    
    <section class="page page_baike">          
          <div class="content_area">
        <div class="detail" id="detail_page">
              <div class="page_baike_detail" data-mark="detail_wrap">
            <header class="pg_header">
                  <h1>{$title}</h1>
                  <p> <span class="time">{$inputtime|date='Y-m-d H:m:s',###}</span> </p>
                </header>
            <section>
                  <div class="summary_wrap"> <span class="summary">摘要：</span> <span class="summary_content">{$description}</span> </div>
                  <article style="min-height:260px;" class="lj-editor-show"> {$content} </article>
                </section>
            <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部-->
                </div>
            </div>
      </div>
        </section>
    <!--/页面--> 
  </div>
    </div>
</body>
</html>
