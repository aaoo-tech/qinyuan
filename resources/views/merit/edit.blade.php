@include('base.header')
    <div class="page-wrapper">
      @include('base.sidebar')
      <div class="page-right">
        @include('base.top-nav')
        <div class="sub-menu clearfix">
          <div class="breadcrumb fl">
            <?php breadcrumb(); ?>
          </div>
          <div class="other fr">
            <div class="btn-set">
              <a class="btn-submit" href="#">提交</a>
            </div>
          </div>
        </div>
        <div class="main-body">
          <div class="article-edit">

            <div class="article-title">
              <span class="label">标&nbsp;&nbsp;题：</span>
              <input id="ipt-title" type="post" value="{{$data['uname']}}" />
            </div>
            
            <div class="article-cont">
              <span class="label fl">正&nbsp;&nbsp;文：</span>
              <div class="formholder cont-form">
                <form action="#" method="post">
                  <textarea id="ipt-cont">

                    <p>赵(Zhào)姓据说出自嬴姓，得姓始祖为造父。传说，造父在华山得八匹千里马，献给周穆王。穆王乘着这八匹马拉的车子西巡狩猎，到了昆仑山上，西王母在瑶池设宴招待。这时东南边的徐偃王造反。造父驾车日行千里，及时赶回帝都，带兵打败了徐偃王。由于造父平叛有功，穆王赐他以赵城（今山西省洪洞县北）。从此，造父及其子孙</p>
                    <p>便以封地为姓，成为赵姓。秦始皇家族为赵氏，宋朝皇室为赵，是国姓，当然放在“百家姓”第一姓。“百家姓”的第一句，“赵”指“权”，“钱”指“金钱”。世间万事权和钱的问题是首要问题。赵姓人口数是当今中国第八大姓，约占全国汉族人口的百分之二点二九。</p>
                    <p>起源主要有三：</p>
                    <p>1、出自嬴姓。形成于西周，远祖为伯益，得姓始祖造父。伯益为颛顼帝裔孙，被舜赐姓嬴。造父为伯益九世孙，是周穆王时著名的驾驭马车能手，因功被周穆王赐予赵城，造父族就称为赵氏。其后在战国初年建立赵国，公元前222年为秦国所灭，其王室贵族和平民百姓纷纷以国名为姓，称赵氏。</p>
                    <p>2、皇帝赐姓。如北宋太宗时，党项族拓跋部首领李继捧和李继迁先后归顺，朝廷分别赐姓名赵保忠和赵保吉；宋神宗时赐木荣姓名赵思忠；宋哲宗时赐河湟羌族隆赞青唐陇拶姓名赵怀德；其弟邦啐勿丁受赐姓名赵怀义；辽政权光禄卿马植因有功于宋室，宋徽宗赐他姓赵，名良嗣；南宋初年，鲜卑族人宇文虚中图谋救出被金朝掳去的宋徽宗、宋钦宗，因寡不敌众被杀，南宋朝廷赐他姓赵。另外，自唐代起，就有大批犹太人进入中国，尤以宋朝为最，犹太移民的姓氏均由皇帝亲赐，据明弘治二年（1489）碑记，当时的犹太人有李、俺、艾、高、穆、赵、金等十七姓，明朝永乐年间，有一位加入中国籍的犹太医生俺诚，以“奏闻有功，钦赐赵姓”。清朝康熙年间福建漳南道按察司赵泱乘也是犹太人。明太祖朱元璋对归顺的蒙古贵族宽大优待，分别赐予汉族汉名以示褒扬。有个蒙古贵族其巴图，受赐名叫赵忠美，他们后代也就姓赵了。在古代，一人受赐国姓，举族以为荣耀，全体族人均改姓国姓，这极大地扩充了赵姓人口。</p>
                    <p>3、少数民族改姓赵氏。随着历史发展，本为汉姓的赵姓，满、蒙古、回、布依、苗、藏、阿昌、土家、朝鲜、瑶、壮、哈尼、德昂、佤、景颇、鄂伦春、锡伯、彝、白、傣等族中也有了赵姓。在古代匈奴人、唐代时云南白蛮部落、唐代胖柯蛮等中也有赵姓。如西汉匈奴人赵安稽，越族人赵光；五代白族人赵善政；元代蒙古族人赵国宝，藏族人赵阿歌昌；南宋瑶族人赵瑞封；清代壮族人赵克广、赵荣正、赵荣章等。辛亥革命后，满族爱新觉罗氏、喜塔喇氏、阿颜觉罗氏、觉尔察氏、伊尔根觉罗氏、阿塔觉罗氏、兆佳氏、鄂卓氏、蒙鄂络氏等均有改姓赵姓者。此外，历史上因避祸、姻亲、过继、入赘等原因改姓赵的也不少</p>

                  </textarea>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: '#ipt-cont',
        language: 'zh_CN',
        height : 500
      });

      $('.btn-submit').on('click',function(){
        $('.family-article form').submit();
        return false
      })
    </script>
@include('base.footer')