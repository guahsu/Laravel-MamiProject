@foreach($diarys as $diary)
<!-- 資料列 -->
<tr>
    <td class="diary_id tableSpace" style="text-align:center">{{ $diary->id }}</td>
    <td class="tableSpace" style="text-align:center">{{ $diary->title }}</td>
    <td class="tableSpace">{{ $diary->breakfast }}</td>
    <td class="tableSpace">{{ $diary->lunch }}</td>
    <td class="tableSpace">{{ $diary->dinner }}</td>
    <td class="tableSpace">{{ $diary->otder }}</td>
    <td class="tableSpace" style="text-align:center">{{ $diary->goal == 'Y' ? '是' : '否'}}</td>
    <td class="tableSpace" style="text-align:center">
        <div style="max-width:80px;">
            <button type="button" class="btn btn-xs btn-info viewDt btn-block"> 顯示 </button>
        </div>
    </td>
</tr>
<tr class="dt-box" dt-box="{{ $diary->id }}" style="display: none;">
    <!-- 資料明細 -->
    <td colspan="1"></td>
    <td colspan="8">
        <div class="dt-row" dt-row="{{ $diary->id }}">
            <table class="table table-bordered">
                <tbody class="dtList">
                    <tr>
                        <td class="grains"     width="20%" colspan="4" style="text-align:center">全穀根莖類 (2 ~ 4.5碗)</td>
                        <td class="dairy"      width="20%" colspan="4" style="text-align:center">低脂乳品類 (1.5杯)</td>
                        <td class="fruits"     width="20%" colspan="4" style="text-align:center">水果類 (2 ~ 4份)</td>
                        <td class="protein"    width="20%" colspan="4" style="text-align:center">豆魚肉蛋類 (4 ~ 7.5份)</td>
                        <td class="vegetables" width="20%" colspan="4" style="text-align:center">蔬菜類 (3 ~ 5份)</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center; padding-right:15px;">
                            <input class="form-control grains-bar" type="text" value="{{ $diary->b_grains + $diary->l_grains + $diary->d_grains + $diary->o_grains }}">
                        </td>
                        <td colspan="4" style="text-align:center; padding-right:15px;">
                            <input class="form-control dairy-bar" type="text" value="{{ $diary->b_dairy + $diary->l_dairy + $diary->d_dairy + $diary->o_dairy }}">
                        </td>
                        <td colspan="4" style="text-align:center; padding-right:15px;">
                            <input class="form-control fruits-bar" type="text" value="{{ $diary->b_fruits + $diary->l_fruits + $diary->d_fruits + $diary->o_fruits }}">
                        </td>
                        <td colspan="4" style="text-align:center; padding-right:15px;">
                            <input class="form-control protein-bar" type="text" value="{{ $diary->b_protein + $diary->l_protein + $diary->d_protein + $diary->o_protein }}">
                        </td>
                        <td colspan="4" style="text-align:center; padding-right:15px;">
                            <input class="form-control vegetables-bar" type="text" value="{{ $diary->b_vegetables + $diary->l_vegetables + $diary->d_vegetables + $diary->o_vegetables }}">
                        </td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align:center">早</td>
                        <td width="5%" style="text-align:center">中</td>
                        <td width="5%" style="text-align:center">晚</td>
                        <td width="5%" style="text-align:center">其</td>
                        <td width="5%" style="text-align:center">早</td>
                        <td width="5%" style="text-align:center">中</td>
                        <td width="5%" style="text-align:center">晚</td>
                        <td width="5%" style="text-align:center">其</td>
                        <td width="5%" style="text-align:center">早</td>
                        <td width="5%" style="text-align:center">中</td>
                        <td width="5%" style="text-align:center">晚</td>
                        <td width="5%" style="text-align:center">其</td>
                        <td width="5%" style="text-align:center">早</td>
                        <td width="5%" style="text-align:center">中</td>
                        <td width="5%" style="text-align:center">晚</td>
                        <td width="5%" style="text-align:center">其</td>
                        <td width="5%" style="text-align:center">早</td>
                        <td width="5%" style="text-align:center">中</td>
                        <td width="5%" style="text-align:center">晚</td>
                        <td width="5%" style="text-align:center">其</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">{{ $diary->b_grains }}</td>
                        <td style="text-align:center">{{ $diary->l_grains }}</td>
                        <td style="text-align:center">{{ $diary->d_grains }}</td>
                        <td style="text-align:center">{{ $diary->o_grains }}</td>
                        <td style="text-align:center">{{ $diary->b_dairy }}</td>
                        <td style="text-align:center">{{ $diary->l_dairy }}</td>
                        <td style="text-align:center">{{ $diary->d_dairy }}</td>
                        <td style="text-align:center">{{ $diary->o_dairy }}</td>
                        <td style="text-align:center">{{ $diary->b_fruits }}</td>
                        <td style="text-align:center">{{ $diary->l_fruits }}</td>
                        <td style="text-align:center">{{ $diary->d_fruits }}</td>
                        <td style="text-align:center">{{ $diary->o_fruits }}</td>
                        <td style="text-align:center">{{ $diary->b_protein }}</td>
                        <td style="text-align:center">{{ $diary->l_protein }}</td>
                        <td style="text-align:center">{{ $diary->d_protein }}</td>
                        <td style="text-align:center">{{ $diary->o_protein }}</td>
                        <td style="text-align:center">{{ $diary->b_vegetables }}</td>
                        <td style="text-align:center">{{ $diary->l_vegetables }}</td>
                        <td style="text-align:center">{{ $diary->d_vegetables }}</td>
                        <td style="text-align:center">{{ $diary->o_vegetables }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </td>
</tr>
<!-- END 資料列 -->
@endforeach