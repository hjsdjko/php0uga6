const base = {
    get() {
        return {
            url : "http://localhost:8080/php0uga6/",
            name: "php0uga6",
            // 退出到首页链接
            indexUrl: 'http://localhost:8080/php0uga6/front/h5/index.html'
        };
    },
    getProjectName(){
        return {
            projectName: "基于微信小程序的社团活动助手"
        } 
    }
}
export default base
