<template>
  <li class="cell" :class="{
    image:image != void 0 ? true : false,
    'right-arrow': link
  }">
      <!-- <em class="number" v-show="number">{{ number }}</em> -->
      <badge :number="number" v-show="number"></badge>
      <template v-if="image != void 0">
        <img :src="imgHttp+image" alt="" v-if="image">
        <img src="../assets/images/default-photo.jpg" alt="" v-else>
      </template>
      <dl>
        <dt>
          <label for="">{{ title }}</label>
          <em v-show="date">{{ date }}</em>
        </dt>
        <dd>
          <label for="">
            <span v-html="label"></span>
          </label>
          <a 
            class="btn btn-default" 
            v-if="buttonName"
            @click="thisInsertInfo"
          >
              {{ buttonName }}
          </a>
        </dd>
      </dl>
      <i class="iconfont icon-arrow" v-if="link"></i>
  </li>
</template>

<script>
import {
  mapActions
} from 'vuex';

// custom components
import Badge from './Badge';

export default {
  name: 'cell',
  props: {
    id: {},
    /**
     * 大标题
     */
    title: {
      type: String,
      required: true
    },
    /**
     * 描述
     */
    label: {
      type: String
    },
    /**
     * 时间
     * 
     */
    date: {
      type: String
    },
    /**
     * button name 如果不设置按钮名称将不显示按钮
     */
    buttonName: {
      type: String
    },
    /**
     * 按钮配置信息
     */
    buttonRoute: {
      type: Object
    },
    /**
     * 图片地址
     */
    image: {
      type: String
    },
    /**
     * 点击链接
     */
    link: {
      type: Boolean
    },
    /**
     * 消息数量
     */
    number: {
      type: Number
    }
  },
  components: {
    Badge
  },
  computed: {
    imgHttp() {
      return window.imgHttp;
    }
  },
  methods: {
    ...mapActions('chat', [
      'insertInfo'
    ]),
    thisInsertInfo() {
      this.$router.push({
        path: this.buttonRoute.path,
        query: this.buttonRoute.query
      });
      this.insertInfo({
        goods_id: this.buttonRoute.query.goods_id,
        store_id: this.buttonRoute.query.sid,
        uid: this.buttonRoute.query.id
      });
    }
  }
};
</script>


<style lang="scss">
  @import '../assets/style/config';
  @import '../assets/style/mixins/common';
  .cell{
    position: relative;
    background: #fff;
    padding: 1.2rem 1rem;
    @include disFlex();
    @include direction(center,initial);
    @include disBox();
    em.badge{
      position: absolute;
      top:1rem;
      left:4rem;
    }
    dl{
      @include flex1-1();
    }
    dt{
      color: $text-color;
      font-size: 1.4rem;
      max-height:4.2rem;
      overflow: hidden;
      @include disFlex();
      @include direction(center,space-between);
      em{
        font-size: 1.2rem;
        color: $subsidiary-color;
        float: right;
      }
    }
    dd{
      font-size: 1.34rem;
      color: $subsidiary-color;
      width: 100%;
      line-height: 1.4;
      @include disBox();
      label{
        display: block;
        margin-right: .4rem;
        @include flex1-1();
        span{
          display: block;
          white-space: nowrap; 
          @include ellipses();
        }
      }
    }
    .btn{
      font-size: 1.1rem;
      text-align: center;
      border-radius: .2rem;
      padding: .1rem .4rem;
      border: 1px solid $color;
      color: $color;
      z-index: 1;
    }
    img{
      width: 4rem;
      height: 4rem;
      margin-right:.8rem;
      border-radius: 9999px;
      display: block;
    }
    .icon-arrow{
      position: absolute;
      font-size:1.3rem;
      color: $subsidiary-color;
      top:50%;
      transform: translateY(-50%)
    }
  }
</style>
