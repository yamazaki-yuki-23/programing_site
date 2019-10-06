<script>
// ここでチャートの種類を選択して...
import { Bar } from 'vue-chartjs'
/**
 * Bar       : 棒グラフ
 * Line      : 折れ線グラフ
 * Doughnut  : ドーナツグラフ
 * Pie       : 円グラフ
 * Radar     : レーダーグラフ
 * Polararea : 極域グラフ
 * Bubble    : バブルグラフ
 * Scatter   : 散布図（mixinでは未対応とのこと）
 **/
export default {
  extends: Bar,
  mounted () {
    // データを流し込むだけ
    this.renderChart({
      labels: ['data-1','data-2','data-3'],
      datasets: [{
        label: 'sample',
        backgroundColor: ['#ddd', '#bbb', "#999S"],
        data: [300, 400, 150],
      }]
    })
  }
}
</script>