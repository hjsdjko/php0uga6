(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-qiandaodengji-add-or-update"],{1378:function(e,r,t){"use strict";var i=t("4ea4");Object.defineProperty(r,"__esModule",{value:!0}),r.default=void 0,t("a481"),t("c5f6"),t("f559"),t("ac6a"),t("28a5"),t("96cf");var o=i(t("3b8d")),n=i(t("e2b1")),a={data:function(){return{cross:"",ruleForm:{shetuanmingcheng:"",huodongfenlei:"",huodongmingcheng:"",huodongtupian:"",huodongdidian:"",qiandaoleixing:"",zhanghao:"",xingming:"",beizhu:"",qiandaoshijian:"",userid:"",longitude:"",latitude:"",fulladdress:""},qiandaoleixingOptions:[],qiandaoleixingIndex:0,user:{},ro:{shetuanmingcheng:!1,huodongfenlei:!1,huodongmingcheng:!1,huodongtupian:!1,huodongdidian:!1,qiandaoleixing:!1,zhanghao:!1,xingming:!1,beizhu:!1,qiandaoshijian:!1,userid:!1,longitude:!1,latitude:!1,fulladdress:!1}}},components:{wPicker:n.default},computed:{baseUrl:function(){return this.$base.url}},onLoad:function(){var e=(0,o.default)(regeneratorRuntime.mark((function e(r){var t,i,o,n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return this.ruleForm.qiandaoshijian=this.$utils.getCurDateTime(),t=uni.getStorageSync("nowTable"),e.next=4,this.$api.session(t);case 4:if(i=e.sent,this.user=i.data,this.ruleForm.zhanghao=this.user.zhanghao,this.ro.zhanghao=!0,this.ruleForm.xingming=this.user.xingming,this.ro.xingming=!0,this.qiandaoleixingOptions="签到,签退".split(","),this.ruleForm.userid=uni.getStorageSync("userid"),r.refid&&(this.ruleForm.refid=r.refid,this.ruleForm.nickname=uni.getStorageSync("nickname")),!r.id){e.next=19;break}return this.ruleForm.id=r.id,e.next=17,this.$api.info("qiandaodengji",this.ruleForm.id);case 17:i=e.sent,this.ruleForm=i.data;case 19:if(this.cross=r.cross,!r.cross){e.next=83;break}o=uni.getStorageSync("crossObj"),e.t0=regeneratorRuntime.keys(o);case 23:if((e.t1=e.t0()).done){e.next=83;break}if(n=e.t1.value,"shetuanmingcheng"!=n){e.next=29;break}return this.ruleForm.shetuanmingcheng=o[n],this.ro.shetuanmingcheng=!0,e.abrupt("continue",23);case 29:if("huodongfenlei"!=n){e.next=33;break}return this.ruleForm.huodongfenlei=o[n],this.ro.huodongfenlei=!0,e.abrupt("continue",23);case 33:if("huodongmingcheng"!=n){e.next=37;break}return this.ruleForm.huodongmingcheng=o[n],this.ro.huodongmingcheng=!0,e.abrupt("continue",23);case 37:if("huodongtupian"!=n){e.next=41;break}return this.ruleForm.huodongtupian=o[n],this.ro.huodongtupian=!0,e.abrupt("continue",23);case 41:if("huodongdidian"!=n){e.next=45;break}return this.ruleForm.huodongdidian=o[n],this.ro.huodongdidian=!0,e.abrupt("continue",23);case 45:if("qiandaoleixing"!=n){e.next=49;break}return this.ruleForm.qiandaoleixing=o[n],this.ro.qiandaoleixing=!0,e.abrupt("continue",23);case 49:if("zhanghao"!=n){e.next=53;break}return this.ruleForm.zhanghao=o[n],this.ro.zhanghao=!0,e.abrupt("continue",23);case 53:if("xingming"!=n){e.next=57;break}return this.ruleForm.xingming=o[n],this.ro.xingming=!0,e.abrupt("continue",23);case 57:if("beizhu"!=n){e.next=61;break}return this.ruleForm.beizhu=o[n],this.ro.beizhu=!0,e.abrupt("continue",23);case 61:if("qiandaoshijian"!=n){e.next=65;break}return this.ruleForm.qiandaoshijian=o[n],this.ro.qiandaoshijian=!0,e.abrupt("continue",23);case 65:if("userid"!=n){e.next=69;break}return this.ruleForm.userid=o[n],this.ro.userid=!0,e.abrupt("continue",23);case 69:if("longitude"!=n){e.next=73;break}return this.ruleForm.longitude=o[n],this.ro.longitude=!0,e.abrupt("continue",23);case 73:if("latitude"!=n){e.next=77;break}return this.ruleForm.latitude=o[n],this.ro.latitude=!0,e.abrupt("continue",23);case 77:if("fulladdress"!=n){e.next=81;break}return this.ruleForm.fulladdress=o[n],this.ro.fulladdress=!0,e.abrupt("continue",23);case 81:e.next=23;break;case 83:this.styleChange();case 84:case"end":return e.stop()}}),e,this)})));function r(r){return e.apply(this,arguments)}return r}(),methods:{styleChange:function(){this.$nextTick((function(){}))},fulladdressTap:function(){var e=this;uni.chooseLocation({success:function(r){console.log(r),e.ruleForm.fulladdress=r.address,e.ruleForm.longitude=r.longitude,e.ruleForm.latitude=r.latitude}})},qiandaoshijianConfirm:function(e){console.log(e),this.ruleForm.qiandaoshijian=e.result,this.$forceUpdate()},qiandaoleixingChange:function(e){this.qiandaoleixingIndex=e.target.value,this.ruleForm.qiandaoleixing=this.qiandaoleixingOptions[this.qiandaoleixingIndex]},huodongtupianTap:function(){var e=this;this.$api.upload((function(r){e.ruleForm.huodongtupian="upload/"+r.file,e.$forceUpdate(),e.$nextTick((function(){e.styleChange()}))}))},getUUID:function(){return(new Date).getTime()},onSubmitTap:function(){var e=(0,o.default)(regeneratorRuntime.mark((function e(){var r,t,i,o,n,a,d,s,l,u;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!this.ruleForm.longitude||this.$validate.isNumber(this.ruleForm.longitude)){e.next=3;break}return this.$utils.msg("经度应输入数字"),e.abrupt("return");case 3:if(!this.ruleForm.latitude||this.$validate.isNumber(this.ruleForm.latitude)){e.next=6;break}return this.$utils.msg("纬度应输入数字"),e.abrupt("return");case 6:if(!this.cross){e.next=22;break}if(o=uni.getStorageSync("statusColumnName"),n=uni.getStorageSync("statusColumnValue"),""==o){e.next=22;break}if(a=uni.getStorageSync("crossObj"),o.startsWith("[")){e.next=18;break}for(d in a)d==o&&(a[d]=n);return s=uni.getStorageSync("crossTable"),e.next=16,this.$api.update("".concat(s),a);case 16:e.next=22;break;case 18:r=Number(uni.getStorageSync("userid")),t=a["id"],i=uni.getStorageSync("statusColumnName"),i=i.replace(/\[/,"").replace(/\]/,"");case 22:if(!t||!r){e.next=44;break}return this.ruleForm.crossuserid=r,this.ruleForm.crossrefid=t,l={page:1,limit:10,crossuserid:r,crossrefid:t},e.next=28,this.$api.list("qiandaodengji",l);case 28:if(u=e.sent,!(u.data.total>=i)){e.next=34;break}return this.$utils.msg(uni.getStorageSync("tips")),e.abrupt("return",!1);case 34:if(!this.ruleForm.id){e.next=39;break}return e.next=37,this.$api.update("qiandaodengji",this.ruleForm);case 37:e.next=41;break;case 39:return e.next=41,this.$api.add("qiandaodengji",this.ruleForm);case 41:this.$utils.msgBack("提交成功");case 42:e.next=52;break;case 44:if(!this.ruleForm.id){e.next=49;break}return e.next=47,this.$api.update("qiandaodengji",this.ruleForm);case 47:e.next=51;break;case 49:return e.next=51,this.$api.add("qiandaodengji",this.ruleForm);case 51:this.$utils.msgBack("提交成功");case 52:case"end":return e.stop()}}),e,this)})));function r(){return e.apply(this,arguments)}return r}(),optionsChange:function(e){this.index=e.target.value},bindDateChange:function(e){this.date=e.target.value},getDate:function(e){var r=new Date,t=r.getFullYear(),i=r.getMonth()+1,o=r.getDate();return"start"===e?t-=60:"end"===e&&(t+=2),i=i>9?i:"0"+i,o=o>9?o:"0"+o,"".concat(t,"-").concat(i,"-").concat(o)},toggleTab:function(e){this.$refs[e].show()}}};r.default=a},"15bf":function(e,r,t){"use strict";t.r(r);var i=t("b8dc"),o=t("eac7");for(var n in o)"default"!==n&&function(e){t.d(r,e,(function(){return o[e]}))}(n);t("6650");var a,d=t("f0c5"),s=Object(d["a"])(o["default"],i["b"],i["c"],!1,null,"7bdd31d6",null,!1,i["a"],a);r["default"]=s.exports},"1f14":function(e,r,t){var i=t("c826");"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var o=t("4f06").default;o("af9d63e2",i,!0,{sourceMap:!1,shadowMode:!1})},6650:function(e,r,t){"use strict";var i=t("1f14"),o=t.n(i);o.a},b8dc:function(e,r,t){"use strict";var i={"w-picker":t("e2b1").default},o=function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("v-uni-view",{staticClass:"content"},[t("v-uni-form",{staticClass:"app-update-pv"},[t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("社团名称")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.shetuanmingcheng,placeholder:"社团名称"},model:{value:e.ruleForm.shetuanmingcheng,callback:function(r){e.$set(e.ruleForm,"shetuanmingcheng",r)},expression:"ruleForm.shetuanmingcheng"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("活动分类")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.huodongfenlei,placeholder:"活动分类"},model:{value:e.ruleForm.huodongfenlei,callback:function(r){e.$set(e.ruleForm,"huodongfenlei",r)},expression:"ruleForm.huodongfenlei"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("活动名称")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.huodongmingcheng,placeholder:"活动名称"},model:{value:e.ruleForm.huodongmingcheng,callback:function(r){e.$set(e.ruleForm,"huodongmingcheng",r)},expression:"ruleForm.huodongmingcheng"}})],1),t("v-uni-view",{staticClass:"cu-form-group",class:"left"==e.left?"":"active",style:{boxShadow:"0 0 4rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"},on:{click:function(r){arguments[0]=r=e.$handleEvent(r),e.huodongtupianTap.apply(void 0,arguments)}}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("活动图片")]),t("v-uni-view",{staticClass:"right-input",staticStyle:{padding:"0"},style:{textAlign:"left"}},[e.ruleForm.huodongtupian?t("v-uni-image",{staticClass:"avator",style:{width:"88rpx",boxShadow:"0 0 16rpx rgba(0,0,0,.3)",borderRadius:"100%",textAlign:"left",height:"88rpx"},attrs:{src:e.baseUrl+e.ruleForm.huodongtupian,mode:"aspectFill"}}):t("v-uni-image",{staticClass:"avator",style:{width:"88rpx",boxShadow:"0 0 16rpx rgba(0,0,0,.3)",borderRadius:"100%",textAlign:"left",height:"88rpx"},attrs:{src:"../../static/gen/upload.png",mode:"aspectFill"}})],1)],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("活动地点")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.huodongdidian,placeholder:"活动地点"},model:{value:e.ruleForm.huodongdidian,callback:function(r){e.$set(e.ruleForm,"huodongdidian",r)},expression:"ruleForm.huodongdidian"}})],1),t("v-uni-view",{staticClass:"cu-form-group select",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("签到类型")]),t("v-uni-picker",{attrs:{value:e.qiandaoleixingIndex,range:e.qiandaoleixingOptions},on:{change:function(r){arguments[0]=r=e.$handleEvent(r),e.qiandaoleixingChange.apply(void 0,arguments)}}},[t("v-uni-view",{staticClass:"uni-input",style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"88rpx"}},[e._v(e._s(e.ruleForm.qiandaoleixing?e.ruleForm.qiandaoleixing:"请选择签到类型"))])],1)],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("账号")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.zhanghao,placeholder:"账号"},model:{value:e.ruleForm.zhanghao,callback:function(r){e.$set(e.ruleForm,"zhanghao",r)},expression:"ruleForm.zhanghao"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("姓名")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{disabled:e.ro.xingming,placeholder:"姓名"},model:{value:e.ruleForm.xingming,callback:function(r){e.$set(e.ruleForm,"xingming",r)},expression:"ruleForm.xingming"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("签到时间")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{placeholder:"签到时间"},on:{click:function(r){arguments[0]=r=e.$handleEvent(r),e.toggleTab("qiandaoshijian")}},model:{value:e.ruleForm.qiandaoshijian,callback:function(r){e.$set(e.ruleForm,"qiandaoshijian",r)},expression:"ruleForm.qiandaoshijian"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"108rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("地址")]),t("v-uni-input",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"110rpx"},attrs:{readonly:!0,placeholder:"请选择地址"},on:{click:function(r){arguments[0]=r=e.$handleEvent(r),e.fulladdressTap.apply(void 0,arguments)}},model:{value:e.ruleForm.fulladdress,callback:function(r){e.$set(e.ruleForm,"fulladdress",r)},expression:"ruleForm.fulladdress"}})],1),t("v-uni-view",{staticClass:"cu-form-group",style:{boxShadow:"0 0 16rpx rgba(0,0,0,.3)",backgroundColor:"rgba(255, 255, 255, 0.25)",borderColor:"#ccc",margin:"0 0 20rpx 0",borderWidth:"0",borderStyle:"solid",height:"308rpx"}},[t("v-uni-view",{staticClass:"title",style:{width:"170rpx",fontSize:"28rpx",color:"rgba(0, 0, 0, 1)",textAlign:"left"}},[e._v("备注")]),t("v-uni-textarea",{style:{boxShadow:"0 0 4rpx rgba(0,0,0,.6) inset",backgroundColor:"rgba(255, 255, 255, 0)",borderColor:"rgba(0,0,0,.6)",borderRadius:"16rpx",color:"rgba(23, 152, 242, 1)",textAlign:"left",borderWidth:"2rpx",fontSize:"28rpx",borderStyle:"solid",height:"280rpx"},attrs:{placeholder:"备注"},model:{value:e.ruleForm.beizhu,callback:function(r){e.$set(e.ruleForm,"beizhu",r)},expression:"ruleForm.beizhu"}})],1),t("v-uni-view",{staticClass:"btn"},[t("v-uni-button",{staticClass:"bg-red",style:{boxShadow:"0 0 16rpx rgba(0,0,0,0) inset",backgroundColor:"#409EFF",borderColor:"#409EFF",borderRadius:"8rpx",color:"#fff",borderWidth:"2rpx",width:"160rpx",fontSize:"28rpx",borderStyle:"solid",height:"80rpx"},on:{click:function(r){arguments[0]=r=e.$handleEvent(r),e.onSubmitTap.apply(void 0,arguments)}}},[e._v("提交")])],1)],1),t("w-picker",{ref:"qiandaoshijian",attrs:{mode:"dateTime",step:"1",current:!1,hasSecond:!1,themeColor:"#333333"},on:{confirm:function(r){arguments[0]=r=e.$handleEvent(r),e.qiandaoshijianConfirm.apply(void 0,arguments)}}})],1)},n=[];t.d(r,"b",(function(){return o})),t.d(r,"c",(function(){return n})),t.d(r,"a",(function(){return i}))},c826:function(e,r,t){var i=t("24fb");r=i(!1),r.push([e.i,'@charset "UTF-8";\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.container[data-v-7bdd31d6]{padding:%?20?%}.content[data-v-7bdd31d6]:after{position:fixed;top:0;right:0;left:0;bottom:0;content:"";background-attachment:fixed;background-size:cover;background-position:50%}uni-textarea[data-v-7bdd31d6]{border:%?1?% solid #eee;border-radius:%?20?%;padding:%?20?%}.title[data-v-7bdd31d6]{width:%?180?%}.avator[data-v-7bdd31d6]{width:%?150?%;height:%?60?%}.right-input[data-v-7bdd31d6]{-webkit-box-flex:1;-webkit-flex:1;flex:1;text-align:left;padding:0 %?24?%}.cu-form-group.active[data-v-7bdd31d6]{-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between}.btn[data-v-7bdd31d6]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-flex-wrap:wrap;flex-wrap:wrap;padding:%?20?% 0}.cu-form-group[data-v-7bdd31d6]{padding:0 %?24?%;background-color:initial;min-height:inherit}.cu-form-group + .cu-form-group[data-v-7bdd31d6]{border:0}.cu-form-group uni-input[data-v-7bdd31d6]{padding:0 %?30?%}.uni-input[data-v-7bdd31d6]{padding:0 %?30?%}.cu-form-group uni-textarea[data-v-7bdd31d6]{padding:%?30?%;margin:0}.cu-form-group uni-picker[data-v-7bdd31d6]::after{line-height:%?88?%}.select .uni-input[data-v-7bdd31d6]{line-height:%?88?%}.input .right-input[data-v-7bdd31d6]{line-height:%?110?%}',""]),e.exports=r},eac7:function(e,r,t){"use strict";t.r(r);var i=t("1378"),o=t.n(i);for(var n in i)"default"!==n&&function(e){t.d(r,e,(function(){return i[e]}))}(n);r["default"]=o.a}}]);