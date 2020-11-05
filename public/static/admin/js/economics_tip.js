var economics = {
    title: '',
    user: '',
    fraction:[],
    elm : null,
    init: function(data,elm){
        this.title = data.title;
        this.user = data.user;
        this.fraction = data.fraction;
        this.elm = elm;
        this.render();
    },
    render:function(){
        let html = '';
        html += '<div class="layui-row"><div class="layui-col-xs12 company">'+this.title+'</div></div>';
        html += '<div class="layui-row"><div class="layui-col-xs12 user">联系电话：'+this.user+'</div></div>';
        for(let i in this.fraction){
            i = Number(i);
            let val = this.fraction[i];
            if ( (i+1) % 12 === 1) {
                html += '<div class="layui-row fraction-box">';
            }
            html += '<div class="layui-col-xs1 box" ><div class="title">'+val.title+'</div><div class="fraction">'+val.fraction+'</div></div>';
            if ((i+1)%12 === 0 || (i+1) === this.fraction.length) {
                html += '</div>';
            }
        }
        html += '';
        let width = '';
        if (this.fraction.length >= 12) {
            width = '750px';
        } else if (this.fraction.length < 4) {
            width = 'auto';
        } else {
            width = 65 * this.fraction.length +'px';
        }
        layer.tips(html,this.elm, {
            area:width,
            skin:'economics-tip',
            tips: 3,
            // time:0
        });
    }
};