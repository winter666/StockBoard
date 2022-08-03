<template>
  <div class="dashboard-editor-container">
    <panel-group @handleSetLineChartData="handleSetLineChartData" />

    <!--    <el-row style="background:#fff;padding:16px 16px 0;margin-bottom:32px;">-->
    <!--      <line-chart :chart-data="lineChartData" />-->
    <!--    </el-row>-->

    <!--    <el-row :gutter="32">-->
    <!--      <el-col :xs="24" :sm="24" :lg="8">-->
    <!--        <div class="chart-wrapper">-->
    <!--          <raddar-chart />-->
    <!--        </div>-->
    <!--      </el-col>-->
    <!--      <el-col :xs="24" :sm="24" :lg="8">-->
    <!--        <div class="chart-wrapper">-->
    <!--          <pie-chart />-->
    <!--        </div>-->
    <!--      </el-col>-->
    <!--      <el-col :xs="24" :sm="24" :lg="8">-->
    <!--        <div class="chart-wrapper">-->
    <!--          <bar-chart />-->
    <!--        </div>-->
    <!--      </el-col>-->
    <!--    </el-row>-->

    <!--    <el-row :gutter="8">-->
    <!--      <el-col :xs="{span: 24}" :sm="{span: 24}" :md="{span: 24}" :lg="{span: 12}" :xl="{span: 12}" style=" margin-bottom:30px;">-->
    <AbstractTable
      :is-on-load="load"
      :data="list"
      :target="'sync'"
      :columns="[
        { name: 'Название интеграции', key: 'name' },
        { name: 'Статус', key: 'status', tag: { getType: (row) => statuses[row.status] } },
        { name: 'Время начала', key: 'created_at', render: (row) => (new Date(row.created_at)).toUTCString() },
        { name: 'Время окончания', key: 'updated_at', render: (row) => (new Date(row.updated_at)).toUTCString() },
      ]"
    />
    <pagination
      v-show="query.total > 0"
      :total="query.total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="fetchSyncronizrion"
    />
    <!--      </el-col>-->
    <!--      <el-col :xs="{span: 24}" :sm="{span: 12}" :md="{span: 12}" :lg="{span: 6}" :xl="{span: 6}" style="margin-bottom:30px;">-->
    <!--        <todo-list />-->
    <!--      </el-col>-->
    <!--      <el-col :xs="{span: 24}" :sm="{span: 12}" :md="{span: 12}" :lg="{span: 6}" :xl="{span: 6}" style="margin-bottom:30px;">-->
    <!--        <box-card />-->
    <!--      </el-col>-->
    <!--    </el-row>-->
  </div>
</template>

<script>
import PanelGroup from './components/PanelGroup';
// import LineChart from './components/LineChart';
// import RaddarChart from './components/RaddarChart';
// import PieChart from './components/PieChart';
// import BarChart from './components/BarChart';
// import BoxCard from './components/BoxCard';
import AbstractTable from '@/components/AbstractTable/AbstractTable';
import SyncResource from '@/api/sync';
import pagination from '@/components/Pagination';

const lineChartData = {
  newVisitis: {
    expectedData: [100, 120, 161, 134, 105, 160, 165],
    actualData: [120, 82, 91, 154, 162, 140, 145],
  },
  messages: {
    expectedData: [200, 192, 120, 144, 160, 130, 140],
    actualData: [180, 160, 151, 106, 145, 150, 130],
  },
  purchases: {
    expectedData: [80, 100, 121, 104, 105, 90, 100],
    actualData: [120, 90, 100, 138, 142, 130, 130],
  },
  shoppings: {
    expectedData: [130, 140, 141, 142, 145, 150, 160],
    actualData: [120, 82, 91, 154, 162, 140, 130],
  },
};

export default {
  name: 'DashboardAdmin',
  components: {
    PanelGroup,
    // LineChart,
    // RaddarChart,
    // PieChart,
    // BarChart,
    // BoxCard,
    AbstractTable,
    pagination,
  },
  data() {
    return {
      list: [],
      query: {
        total: 0,
        page: 1,
        limit: 10,
      },
      load: true,
      statuses: {
        COMPLETED: 'success',
        IN_PROGRESS: 'warning',
        FAILED: 'danger',
      },
      lineChartData: lineChartData.newVisitis,
    };
  },
  created() {
    this.fetchSyncronizrion();
  },
  methods: {
    handleSetLineChartData(type) {
      this.lineChartData = lineChartData[type];
    },
    async fetchSyncronizrion() {
      try {
        const { data } = await (new SyncResource()).list(this.query);
        this.list = data.data;
        this.query.page = parseInt(data.current_page);
        this.query.total = parseInt(data.total);
        this.query.limit = parseInt(data.per_page);
      } catch (e) {
        console.log(e);
      } finally {
        this.load = false;
      }
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard-editor-container {
  padding: 32px;
  background-color: rgb(240, 242, 245);
  .chart-wrapper {
    background: #fff;
    padding: 16px 16px 0;
    margin-bottom: 32px;
  }
}
</style>
