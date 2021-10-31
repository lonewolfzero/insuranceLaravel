<!DOCTYPE html>
<html>

<head>
  <title>HARDCOPY</title>
  <style>
    .borderbot {
      border-bottom: 1px black solid;
    }

    .bordertop {
      border-top: 1px black solid;
    }

    .borderrig {
      border-right: 1px black solid;
    }

    @page {
      margin: 0;
    }

    body {
      padding: 50px 40px;
      font-size: 0.8em;
      font-family: Arial, Helvetica, sans-serif
    }

    table tr td {
      padding: 2px 2px;
      margin: 0px 0px;
      vertical-align: top;
    }

    .w-25 {
      width: 25%
    }

    .w-50 {
      width: 50%
    }

    .w-75 {
      width: 75%
    }

    .w-100 {
      width: 100%
    }

    .mb-1 {
      margin-bottom: 0.1rem
    }

    .mb-2 {
      margin-bottom: 0.8rem
    }

    .px-2 {
      padding: 0 0.3rem
    }

    .font-weight-bold {
      font-weight: bold
    }

    .text-center {
      text-align: center
    }

    .text-left {
      text-align: left
    }

    .text-right {
      text-align: right
    }

    .d-flex {
      display: flex
    }

    .wrapword {
      word-wrap: break-word
    }
  </style>
</head>

<body>
  <center colspan=2 class="text-center mb-2" style="font-size: 1.3rem">Definite Loss Advice</center>
  <table class="w-100">
    <tr>
      <td style="width: 1px">01.</td>
      <td style="width: 120px">Reg. Comp</td>
      <td style="width: 1px">:</td>
      <td>{{ @$claim->reg_comp }}</td>

      <td style="width: 1px">13.</td>
      <td style="width: 120px">Occ / Vessel</td>
      <td style="width: 1px">:</td>
      <td style="text-transform: uppercase">{{ @$claim->slip->occupation->description }}</td>
    </tr>
    <tr>
      <td>02.</td>
      <td>Type Doc.</td>
      <td>:</td>
      @php
      if (@$claim->status_flag == 1) {
      $sts = "PLA";
      } elseif (@$claim->status_flag == 2) {
      $sts = "INTERIM";
      } elseif (@$claim->status_flag == 3) {
      $sts = "DLA";
      }
      @endphp
      <td>{{ $sts }}</td>

      <td>14.</td>
      <td>Construction</td>
      <td>:</td>
      <td>{{ @$claim->slip->build_const }}</td>
    </tr>
    <tr>
      <td>03.</td>
      <td>Dt. Of Receipt</td>
      <td>:</td>
      <td>{{ date('d/m/Y',strtotime(@$claim->date_receipt)) }}</td>

      <td>15.</td>
      <td>Currency TSI</td>
      <td>:</td>
      <td>{{ @$claim->slip->insureddata->currency->curr->code }}</td>
    </tr>
    <tr>
      <td>04.</td>
      <td>Doc. Nr</td>
      <td>:</td>
      <td>{{ @$claim->docpladla }}</td>

      <td>16.</td>
      <td>TSI</td>
      <td>:</td>
      <td class="text-right">
        {{ strval(number_format(@$claim->slip->share_tsi, 2, '.', ',')) }}
      </td>
    </tr>
    <tr>
      <td>05.</td>
      <td>Date Of Doc.</td>
      <td>:</td>
      <td>{{ date('d/m/Y',strtotime(@$claim->date_document)) }}</td>

      <td>17.</td>
      <td>Co. Share</td>
      <td>:</td>
      <td class="text-right">
        {{ strval(number_format(@$claim->nasre_liab, 2, '.', ',')) }}%</td>
    </tr>
    <tr>
      <td>06.</td>
      <td>Ceding - Broker</td>
      <td>:</td>
      <td colspan=5>{{ @$claim->slip->cedingbroker->name }}</td>
    </tr>
    <tr>
      <td colspan=3></td>
      <td colspan=5>{{ @$claim->slip->ceding->name }}</td>
    </tr>
    <tr>
      <td>07.</td>
      <td>KOC</td>
      <td>:</td>
      <td>{{ @$claim->slip->kindcontract->description }}</td>

      <td>18.</td>
      <td>Nasional Re's Liab</td>
      <td>:</td>
      <td class="text-right">
        {{ strval(number_format(@$claim->nasre_liabdesc, 2, '.', ',')) }}</td>
    </tr>
    <tr>
      <td>08.</td>
      <td>COB</td>
      <td>:</td>
      <td>{{ @$claim->slip->corebusiness->description }}</td>

      <td>19.</td>
      <td>Ctr. Reff</td>
      <td>:</td>
      <td>{{ @$claim->number }}</td>
    </tr>
    <tr>
      <td>09.</td>
      <td>U/Y</td>
      <td>:</td>
      <td>{{ @$claim->slip->insureddata->uy }}</td>

      <td>20.</td>
      <td>Cause Of Loss</td>
      <td>:</td>
      <td>{{ @$claim->desc_causeofloss }}</td>
    </tr>
    <tr>
      <td>10.</td>
      <td>Reins. Priod</td>
      <td>:</td>
      <td>
        {{date('d/m/Y',strtotime(@$claim->slip->reinsurance_period_from)) }} -
        {{ date('d/m/Y',strtotime(@$claim->slip->reinsurance_period_to))}}</td>

      <td>21.</td>
      <td>Nature Of Loss</td>
      <td>:</td>
      <td>{{ @$claim->descnatureofloss }}</td>
    </tr>
    <tr>
      <td>11.</td>
      <td>Insured</td>
      <td>:</td>
      <td>{{ @$claim->slip->insureddata->insured_name }}</td>

      <td>22.</td>
      <td>Date Of Loss</td>
      <td>:</td>
      <td>{{ date('d/m/Y',strtotime(@$claim->date_of_loss)) }}</td>
    </tr>
    @if(count(@$addresses) > 0)
    @foreach (@$addresses as $address)
    <tr>
      @if($loop->index == 0)
      <td>12.</td>
      <td>Risk Code</td>
      <td>:</td>
      @if (@$claim->slip->slip_type == "mc" || @$claim->slip->slip_type == "mh")
      <td style="text-transform: uppercase">{{ @$address->ship_name }}</td>
      @else
      <td style="text-transform: uppercase">{{ @$address->address }}</td>
      @endif
      <td>23.</td>
      <td>Curr Loss</td>
      <td>:</td>
      <td>{{ @$claim->currloss->code }}</td>
      @elseif($loop->index > 0)
      <td></td>
      <td></td>
      <td></td>
      @if (@$claim->slip->slip_type == "mc" || @$claim->slip->slip_type == "mh")
      <td style="text-transform: uppercase">{{ @$address->ship_name }}</td>
      @else
      <td style="text-transform: uppercase">{{ @$address->address }}</td>
      @endif
      @endif
    </tr>
    @endforeach
    @endif
    <tr>
      <td colspan=2>Loss Description</td>
      <td>:</td>
      <td></td>
    </tr>
    @foreach ($claim->lossdescs as $ld)
    <tr>
      <td colspan=3><span>&nbsp;&nbsp;</span>{{ $ld->descLoss->desc_name }}</td>
      <td class="text-right" style="padding-right: 30px">
        {{ $ld->descLoss->factor == -1 ? '(' : '' }}{{ strval(number_format(@$ld->amount, 2, '.', ',')) }}{{ $ld->descLoss->factor == -1 ? ')' : '' }}
      </td>

      <td colspan=4></td>
    </tr>
    @endforeach
    <tr>
      <td>24.</td>
      <td>Loss Amount</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px">
        {{ strval(number_format(@$claim->total_loss_amount, 2, '.', ',')) }}
      </td>

      <td>30.</td>
      <td>Nr. CE Reff</td>
      <td>:</td>
      <td>{{ @$claim->cereffno }}</td>
    </tr>
    <tr>
      <td>25.</td>
      <td>Cedant Share</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px">
        {{ strval(number_format(@$claim->ced_share, 2, '.', ',')) }}</td>

      <td>31.</td>
      <td>Nr. CE</td>
      <td>:</td>
      <td>{{ @$claim->ceno }}</td>
    </tr>
    <tr>
      <td>26.</td>
      <td>Cedant OR</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px">{{ strval(number_format(0, 2, '.', ',')) }}
      </td>

      <td>32.</td>
      <td>Date Of Production</td>
      <td>:</td>
      <td>{{ date('d/m/Y',strtotime(@$claim->dateofprod)) }}</td>
    </tr>
    <tr>
      <td>27.</td>
      <td>Deductible / UR</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px">{{ strval(number_format(0, 2, '.', ',')) }}
      </td>

      <td>33.</td>
      <td>Date Entry</td>
      <td>:</td>
      <td>{{ date('d/m/Y',strtotime(@$claim->dateofentry)) }}</td>
    </tr>
    <tr>
      <td>28.</td>
      <td>Treaty Loss</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px"></td>

      <td>34.</td>
      <td>User</td>
      <td>:</td>
      <td style="text-transform: uppercase">{{ @$claim->userce->name ?? @$claim->user->name }}</td>
    </tr>
    <tr>
      <td>26.</td>
      <td>Nasional Re's Share</td>
      <td>:</td>
      <td class="text-right" style="padding-right: 30px">
        {{ strval(number_format(@$claim->nasre_share_loss, 2, '.', ',')) }}
      </td>

      <td colspan=4></td>
    </tr>
  </table>
  <br>
  <p>NASIONAL RE SHARE</p>
  <hr>
  <table class="w-100" style="border-spacing: 10px 0">
    <tr>
      <td colspan=2></td>
      <td class="text-center" style="width: 140px">Liability</td>
      <td class="text-center" style="width: 140px">Loss</td>
      <td class="text-center" style="width: 140px">Recovery Claim</td>
      <td class="text-center">Retro Contact</td>
    </tr>
    @if (false)
    <tr>
      <td style="width: 80px">QS</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td>20NM111110</td>
    </tr>
    <tr>
      <td>Special Arr. 1</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
    <tr>
      <td>Facultive</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
    <tr>
      <td>Extra O/R</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
    <tr>
      <td>Pure O/R</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
    <tr>
      <td>Special Arr. 2</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
    <tr>
      <td>Special Arr. 3</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
      <td></td>
    </tr>
  </table>
  <table style="border-spacing: 10px 0">
    <tr>
      <td>Total Recovery</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
    </tr>
    <tr>
      <td>NR's Gross Retention</td>
      <td>:</td>
      <td class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</td>
    </tr>
    @endif
  </table>
  <hr>
  <p>Loss Remark's</p>
</body>

</html>