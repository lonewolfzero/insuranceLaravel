<div class="float-right">
  <button class="btn btn-sm btn-primary" id="btn_new_doc" style="display: none" form="form_new_doc">New</button>
</div>
<form action="/treaty/prop/credit/entry" method="get" id="form_new_doc" style="display: none">
  <input name="treaty_code" value="{{ @$subdetail->getprop->treaty_code }}">
  <input name="treaty_year" value="{{ @$subdetail->getprop->treaty_year }}">
  <input name="ceding_broker" value="{{ @$subdetail->getprop->ceding_broker }}">
</form>