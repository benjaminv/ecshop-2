var app = getApp()
Page({
  data: {
    hidden: false,
    list: null,
    isListData: true, //用于判断orderListData数组是不是空数组，默认true，空的数组
  },
  onLoad: function(options) {
    var that = this
    var order_sn = options.objectId;
    var relname = options.relname;
    var name = options.name;
    that.setData({
      order_sn: order_sn,
      relname: name
    })
    //调用应用实例的方法获取全局数据
    app.dscRequest(("user/order/logistics"), {
        relname: relname,
        order_sn: order_sn
      })
      .then((res) => {
        if (res.data.data === '') {
          wx.showModal({
            title: '提示',
            content: '暂无记录',
            showCancel: false,
            success(res) {
              if (res.confirm) {
                wx.navigateBack({
                  delta: 1
                })
              }
            }
          })
        }
        if (res.data.data != undefined) {
          that.setData({
            list: res.data.data
          })
        }
      })
  },
  //快捷导航
  commonNav: function() {
    var that = this;
    var nav_select
    that.setData({
      nav_select: !that.data.nav_select
    });
  },
  nav: function(e) {
    var that = this;
    var cont = e.currentTarget.dataset.index;
    if (cont == "home") {
      wx.switchTab({
        url: '../index/index',
      });
    } else if (cont == "fenlei") {
      wx.switchTab({
        url: '../category/index',
      });
    } else if (cont == "cart") {
      wx.switchTab({
        url: '../flow/index',
      });
    } else if (cont == "profile") {
      wx.switchTab({
        url: '../user/index',
      });
    }
  },
})