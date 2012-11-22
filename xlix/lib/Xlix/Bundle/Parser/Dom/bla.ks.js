(function(g,k,a){
    g.namespace("window.zz.page.explore").scenes=new function(){
        var f=this,d=!1,b=1,c={
            b:"date",
            d:"a"
        },e={
            b:"date",
            d:"a"
        },h="date",p="a",l,q,j,o=!1,n,r,m,t,u,s,x,w,v,B,y,F,C,z,D,A,I,E,G,J,H;
        this._initTemplate=function(){
            n=a("#exploreSiteFilter, #exploreTagFilter, #exploreModelFilter");
            r=a("#exploreSiteFilter");
            m=a("#exploreTagFilter");
            t=a("#exploreModelFilter");
            u=a("#exploreSortBy");
            s=a("#explorePeriod");
            x=a(".explore-result-on-page");
            w=a(".explore-result-on-page a");
            v=a(".explore-viewmode");
            B=a(".explore-preferences .reset");
            y=a("#explore-result");
            F=a("span.total-count");
            C=a(".paginationui-container");
            z=a(".filter-list");
            D=a(".filter-list a");
            A=a("#new-filters a");
            I=a("#new-filters input");
            E=a(".explore-preferences .nav-flyout-box");
            G=a("#explore-filter-panel");
            J=a("#explore-show-panel h2 span.title");
            H=a(".advanced-search");
            B.bind("click.explore",function(){
                e=a.extend(!0,{},c);
                b=1;
                n.val([]);
                f._registerHash();
                zz.ui.multifilter.refreshAll();
                return!1
                });
            w.bind("click.explore",function(){
                w.removeClass("active");
                a(this).addClass("active");
                zz.member.preferences.set("explore.scenes.quantity",a(this).html());
                f._update();
                return!1
                });
            v.find("a").bind("click.explore",function(){
                v.find("a.active").removeClass("active");
                a(this).addClass("active");
                zz.member.preferences.set("explore.scenes.mode",a(this).attr("href").split("#")[1]);
                f._update();
                return!1
                });
            n.change(function(){
                b=1;
                e[a(this).attr("name")]=a(this).val();
                f._registerHash()
                });
            z.find("li").size()||z.html('<li class="about">You can save currently selected filters and access the result from your homepage.</li>');
            u.find("a").bind("click.explore",function(){
                u.find("a.active").removeClass("active");
                e.b=a(this).addClass("active").attr("sort-by");
                b=1;
                f._registerHash();
                return!1
                });
            s.find("a").bind("click.explore",function(){
                s.find("a.active").removeClass("active");
                e.d=a(this).addClass("active").attr("period");
                b=1;
                f._registerHash();
                return!1
                });
            zz.ui.multifilter.create(r);
            zz.ui.multifilter.create(t);
            zz.ui.multifilter.create(m);
            E.size()&&E.flybox();
            A.bind("click.explore",L);
            D.find("span.name").bind("click.explore",
                function(){
                    E.find(".nav-flyout-tab a").click()
                    });
            D.find("span.icon-x").bind("click.explore",K);
            H.bind("click.explore",function(){
                o=!0;
                G.show();
                u.find("a").removeClass("active").addClass("disabled");
                s.find("a").removeClass("active").addClass("disabled")
                });
            f._ajaxifyPagination()
            };
            
        this._ajaxifyPagination=function(){
            C.find("a").bind("click.explore",function(){
                b=a(this).attr("href").split("page=")[1];
                f._registerHash();
                g.scrollTo(0,360);
                zz.upsells.refreshFooter();
                return!1
                })
            };
            
        this._init=function(){
            d=!0;
            f._initTemplate();
            g.log("zz.page.explore.scenes._init");
            zz.history.init(zz.page.explore.scenes.history);
            a.browser.msie&&(7===parseInt(a.browser.version,10)||7==k.documentMode)&&f._update()
            };
            
        var L=function(){
            var b=I.val(),c=JSON.stringify(e);
            b&&b.length&&a.get("/filters/add/",{
                name:b,
                params:c
            },function(a){
                a.status?(I.removeClass("error").val(""),z.append('<li class="nav-list-button"><a href="'+a.url+'"><span class="name">'+a.name+'</span><span class="icon-12x12 icon-x" filter-id="'+a.filterId+'"></span></a></li>'),
                    z.find("li:last span.icon-x").bind("click.explore",K),z.find("li.about").remove()):a.error&&10===a.errorCode&&I.addClass("error")
                },"json");
            return!1
            },K=function(){
            if(confirm("Are you sure you want to delete this filter ?")){
                $this=a(this);
                var b=$this.attr("filter-id");
                a.get("/filters/delete/",{
                    filterId:b
                },function(){
                    $this.parents("li").remove()
                    })
                }
                return!1
            };
            
        this._readHash=function(b){
            var d=a.extend(!0,{},c),b=(""+b).replace("#","").replace("!","").split("/"),f={
                s:"s",
                t:"t",
                m:"m"
            },h=/=/;e=d;
            for(var g=
                0;g<b.length;g++)h.test(b[g])&&(param=b[g].split("="),value=param[1].split("-"),d[param[0]]=!value[1]&&!f[param[0]]?value[0]:value);
            return e=d
            };
            
        this._refreshExploreUi=function(){
            var a,b,c;
            a=r.val()||[];
            b=m.val()||[];
            c=t.val()||[];
            if(81==parseInt(a,10))location.href="/series";
            e.s=e.s||[];
            e.t=e.t||[];
            e.m=e.m||[];
            e.v=v.find("a.active").attr("href").split("#")[1];
            e.vl=x.find(".active").html();
            if(a.join("-")!==e.s.join("-")||zz.history._firstTime)r.val(e.s||[]),zz.ui.multifilter.get(r).refresh();
            if(b.join("-")!==
                e.t.join("-")||zz.history._firstTime)m.val(e.t||[]),zz.ui.multifilter.get(m).refresh();
            if(c.join("-")!==e.m.join("-")||zz.history._firstTime)t.val(e.m||[]),zz.ui.multifilter.get(t).refresh();
            "searchresult"!==e.b&&(o=!1,H.hide(),G.show(),u.find("a").removeClass("disabled"),s.find("a").removeClass("disabled"),E.show());
            "searchresult"===e.b&&!1===o?(G.hide(),H.show(),E.hide()):"searchresult"===e.b&&!0===o&&(G.show(),H.hide(),E.hide());
            u.find("a.active").removeClass("active");
            u.find("a[sort-by='"+e.b+
                "']").addClass("active");
            s.find("a.active").removeClass("active");
            s.find("a[period='"+e.d+"']").addClass("active")
            };
            
        this._registerHash=function(){
            var a;
            a="b="+e.b+"/d="+e.d;
            e.s=e.s||[];
            e.m=e.m||[];
            e.t=e.t||[];
            e.s.length&&(a+="/s="+e.s.join("-"));
            e.t.length&&(a+="/t="+e.t.join("-"));
            e.m.length&&(a+="/m="+e.m.join("-"));
            1<b&&(a+="/page="+b);
            a="#!"+a;
            zz.history.load(a);
            return a
            };
            
        this._update=function(){
            f._refreshExploreUi();
            var b=zz.convertParamToPath(e);
            log("/explore/ajax/"+b);
            a.ajax({
                url:"/explore/ajax/"+
                b,
                dataType:"json",
                success:f._updateSuccess,
                error:function(a,b){
                    if("parsererror"===b){
                        var c;
                        try{
                            c=eval("("+a.responseText+")")
                            }catch(e){}
                        f._updateSuccess(c)
                        }
                    }
            });
    _gaq.push(["_trackPageview","/explore/ajax/"+b]);
    f._trackParams()
    };
    
this._updateSuccess=function(b){
    F.html(b.count);
    0!==b.count?y.html(b.scenes):y.html(f._oops());
    C.html(b.pagination);
    b.searchString?J.html('Scenes Found for "'+b.searchString+'"'):J.html("Scenes Matching Criteria");
    0!==b.count&&(a(".scene-card, .scene-postcard",y).sceneCard(),
        f._ajaxifyPagination());
    return!0
    };
    
this._oops=function(){
    return'<iframe src="/partners/oops/" marginheight="0" marginwidth="0"  allowtransparency="true" frameborder="0" scrolling = "no" > </iframe>'
    };
    
this.getParams=function(){
    return e
    };
    
this._trackParams=function(){
    if(e.b&&e.b!==h)_gaq.push(["_trackEvent","explore.scenes","search.by",h]),h=e.b;
    if(e.d&&e.d!==p)_gaq.push(["_trackEvent","explore.scenes","search.period",p]),p=e.d;
    if(e.s)a.each(e.s,function(b,c){
        l?-1===a.inArray(c,l)&&(site=c+"-"+a("#exploreSiteFilter").find("option[value='"+
            c+"']").html(),_gaq.push(["_trackEvent","explore.scenes","search.site",site])):(site=c+"-"+a("#exploreSiteFilter").find("option[value='"+c+"']").html(),_gaq.push(["_trackEvent","explore.scenes","search.site",site]))
        }),l=e.s;
    if(e.m)a.each(e.m,function(b,c){
        q?-1===a.inArray(c,q)&&(model=c+"-"+a("#exploreModelFilter").find("option[value='"+c+"']").html(),_gaq.push(["_trackEvent","explore.scenes","search.model",model])):(model=c+"-"+a("#exploreModelFilter").find("option[value='"+c+"']").html(),_gaq.push(["_trackEvent",
            "explore.scenes","search.model",model]))
        }),q=e.m;
    if(e.t)a.each(e.t,function(b,c){
        j?-1===a.inArray(c,j)&&(tag=c+"-"+a("#exploreTagFilter").find("option[value='"+c+"']").html(),_gaq.push(["_trackEvent","explore.tags","search.tag",tag])):(tag=c+"-"+a("#exploreTagFilter").find("option[value='"+c+"']").html(),_gaq.push(["_trackEvent","explore.tags","search.tag",tag]))
        }),j=e.t;
    return!0
    };
    
return{
    init:function(){
        d||f._init();
        return!1
        },
    update:function(){
        hash=f._registerHash();
        f._readHash(hash)
        },
    history:function(a){
        f._readHash(a);
        f._update()
        },
    queueList:function(){
        f._update()
        },
    getParam:function(){
        return f.getParams()
        }
    }
}
})(this,document,jQuery);