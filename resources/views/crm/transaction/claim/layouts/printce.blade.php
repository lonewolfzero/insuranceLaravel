<!DOCTYPE html>
<html>

<head>
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('jqueryui/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/fontawesome-free/css/all.min.css') }}"> --}}
  <title>Report CE</title>
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
      padding: 60px 30px 30px 30px;
      font-size: 0.6em;
      font-family: Arial, Helvetica, sans-serif
    }

    table {
      border-spacing: 0;
      border-collapse: collapse;
    }


    table tr td {
      padding: 1px 1px;
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

    header {
      position: fixed;
      top: 20px;
      left: 0px;
      right: 0px;
    }

    footer {
      position: fixed;
      bottom: 0px;
      left: 0px;
      right: 0px;
      height: 30px;
      padding-right: 30px;
      padding-left: 30px;
      text-align: right;
    }

    footer .pagenum:before {
      content: counter(page);
    }
  </style>
</head>

<body>
  <header>
    <div class="w-50 text-center mb-1">
      <div class="font-weight-bold">{{ $company ?? "asd" }}</div>
      <div class="font-weight-bold">{{ $division ?? "asd"}}</div>
    </div>
  </header>
  <footer>
    <div class="pagenum-container">
      <table class="w-100">
        <tr>
          <td><b>{{ @$claim->cereffno }}</b> - {{ date('d/m/Y', strtotime(@$claim->dateprintce)) }}</td>
          <td class="text-right">Page <span class="pagenum"></span></td>
        </tr>
      </table>
    </div>
  </footer>
  <main>
    <table class="w-100 text-center">

      <tr>
        <th class="w-50 text-left borderbot bordertop borderrig" style="padding-left: 1rem">CLAIM EXAMINATION NON
          MARINE</th>
        <th class="w-50 borderbot bordertop bordertop">BOARD'S OF DECISION</th>
      </tr>

      <tr>

        <td valign="top" class="borderbot bordertop borderrig px-2">
          <div class="d-flex" style="font-size: 0.6rem">
            <div class="text-left">No. <b>{{ @$claim->cereffno }}</b></div>
            <div class="text-right mr-4" style="margin-right: 1rem">Date:
              {{ date('d/m/Y', strtotime(@$claim->dateprintce)) }}</div>
          </div>
          <div class="mb-1">
            <table class="text-left">
              <tr>
                <th style="width: 100px">CLAIM'S FILE NAME</th>
                <td style="width: 1px"></td>
                <td></td>
              </tr>
              <tr>
                <td>Business</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->slip->corebusiness->description }}</td>
              </tr>
              <tr>
                <td>Cedant</td>
                <td class="text-right">: </td>
                <td class="wrapword">{{ @$claim->slip->cedingbroker->name }}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="wrapword">{{ @$claim->slip->ceding->name }}</td>
              </tr>
              <tr>
                <td>Name of the Insured(s)</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->slip->insureddata->insured_name }} {{ @$claim->slip->insureddata->insured_suffix }}</td>
              </tr>
              <tr>
                <td>Type of Risk</td>
                <td class="text-right">: </td>
                <td style="text-transform: uppercase">{{ @$claim->slip->occupation->description }}</td>
              </tr>
              <tr>
                <td>Construction</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->slip->build_const }}</td>
              </tr>
              @foreach (@$addresses as $address)
              <tr>
                <td>@if($loop->index == 0) Location / Vessel @endif</td>
                <td class="text-right">@if($loop->index == 0) : @endif</td>
                @if (@$claim->slip->slip_type == "mc" || @$claim->slip->slip_type == "mh")
                <td style="text-transform: uppercase">{{ @$address->ship_name }}</td>
                @else
                <td style="text-transform: uppercase">{{ @$address->address }}</td>
                @endif
              </tr>
              @endforeach
            </table>
          </div>

        </td>

        <td style="vertical-align: bottom !important;" class="borderbot bordertop px-2 mb-1">

          <div style="position: absolute; top: 0">
            <div><b>AGREED / NOT AGREED</b></div>
            <div><b>Notes / Comments (if any)</b></div>
          </div>

          <div>
            <div><b>{{ @$claim->userboard->name }}</b></div>
            <table class="w-100">
              <tr>
                <td class="text-left">Signature</td>
                <td class="text-left">Date</td>
              </tr>
            </table>
          </div>

        </td>

      </tr>

      <tr>
        <td valign="top" class="borderbot bordertop borderrig text-left px-2">
          <div><b>DESCRIPTION OF RISK</b></div>

          <div class="mb-1">
            <table>
              <tr>
                <td style="width: 100px">Cession Bordereaux</td>
                <td colspan=2></td>
              </tr>
              <tr>
                <td>R/I Document No</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->doc_number }}</td>
              </tr>
              <tr>
                <td>Periode</td>
                <td class="text-right">: </td>
                <td>{{ date('d/m/Y',strtotime(@$claim->slip->reinsurance_period_from)) }} to
                  {{ date('d/m/Y',strtotime(@$claim->slip->reinsurance_period_to)) }}</td>
              </tr>
              <tr>
                <td>Policy Condition</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->slip->corebusiness->description }}</td>
              </tr>
              <tr>
                <td>Currency</td>
                <td class="text-right">: </td>
                <td>IDR</td>
              </tr>
              <tr>
                <td>TSI</td>
                <td class="text-right">: </td>
                <td>{{  strval(number_format(@$claim->slip->total_sum_insured, 2, '.', ','))  }}</td>
              </tr>
            </table>
          </div>
        </td>

        <td valign="top" class="borderbot bordertop text-left px-2">
          <div><b>DESCRIPTION OF LOSS</b></div>

          <div class="mb-1">
            <table style="width: 100%">
              <tr>
                <td style="width: 25%"></td>
                <td style="width: 1px"></td>
                <td style="width: 70%"></td>
              </tr>
              <tr>
                <td>PLA No. / Dated</td>
                <td class="text-right">: </td>
                <td>{{ @$docpla }}</td>
              </tr>
              <tr>
                <td>DLA No. / Dated</td>
                <td class="text-right">: </td>
                <td>{{ @$claim->docpladla }}</td>
              </tr>
              <tr>
                <td>Date of Loss</td>
                <td class="text-right">: </td>
                <td>{{ date('d/m/Y',strtotime(@$claim->date_of_loss)) }}</td>
              </tr>
              @foreach (@$addresses as $address)
              <tr>
                <td>@if($loop->index == 0) Location / Vessel @endif</td>
                <td class="text-right">@if($loop->index == 0) : @endif</td>
                @if (@$claim->slip->slip_type == "mc" || @$claim->slip->slip_type == "mh")
                <td style="text-transform: uppercase">{{ @$address->ship_name }}</td>
                @else
                <td style="text-transform: uppercase">{{ @$address->address }}</td>
                @endif
              </tr>
              @endforeach
              <tr>
                <td>Cause of Loss</td>
                <td class="text-right">: </td>
                <td>LIGHTNING</td>
              </tr>
              <tr>
                <td>Loss Amount</td>
                <td class="text-right">: </td>
                <td>
                  <span class="text-left" style="float: left">IDR</span>
                  <span class="text-right"
                    style="float: right">{{ strval(number_format(@$claim->total_loss_amount, 2, '.', ',')) }}
                  </span>
                </td>
              </tr>
              <tr>
                <td>Loss Expenses</td>
                <td class="text-right">: </td>
                <td>
                  <span class="text-left" style="float: left"></span>
                  <span class="text-right" style="float: right">{{ strval(number_format(0, 2, '.', ',')) }}
                  </span>
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>

      <tr>

        <td valign="top" class="borderbot bordertop borderrig text-left px-2">
          <div><b>CEDANT SHARE ON THE RISK</b></div>
          <div class="mb-1">
            <table class="w-100">
              <tr>
                <td class="w-25"></td>
                <td>
                  <div>
                    <div>{{ @$claim->slip->insureddata->uy }}</div>
                    <div>{{strval(number_format(@$claim->slip->total_sum_insured, 2, '.', ',')) ?? '0.00' }}</div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </td>

        <td valign="top" class="borderbot bordertop text-left px-2">
          <div><b>CEDANT SHARE ON THE LOSS</b></div>
          <div class="mb-1">
            <div>{{ @$claim->slip->insureddata->uy }}</div>
            <div>{{strval(number_format(@$claim->ced_share, 2, '.', ',')) ?? '0.00' }}</div>
          </div>
        </td>

      </tr>

      <tr>

        <td valign="top" class="borderbot bordertop borderrig text-left px-2">
          <div><b>NASIONALRE'S SHARE ON THE RISK</b></div>
          <div class="mb-1">
            <table class="w-100">
              <tr>
                <td class="w-25"></td>
                <td>
                  <div>
                    <div>{{ @$claim->slip->insureddata->uy }}</div>
                    <div>{{ @$claim->slip->kindcontract->description }}</div>
                    <div>{{strval(number_format(@$claim->slip->share_tsi, 2, '.', ',')) ?? '0.00' }}</div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </td>

        <td valign="top" class="borderbot bordertop text-left px-2">
          <div><b>NASIONALRE'S SHARE ON THE LOSS</b></div>
          <div class="mb-1">
            <div>{{ @$claim->slip->insureddata->uy }}</div>
            <br>
            <div>{{ strval(number_format(@$claim->nasre_share_loss, 2, '.', ',')) }}</div>
          </div>
        </td>

      </tr>

      <tr>
        <td valign="top" class="borderbot bordertop borderrig px-2">
          <table class="w-100 mb-1">
            <tr>
              <td class="w-50 text-left"><b>RETRO'S SHARE ON THE RISK</b></td>
              <td class="w-25">{{ @$claim->slip->insureddata->uy }}</td>
              <td class="w-25">{{ @$claim->slip->insureddata->uy }}</td>
            </tr>
            @if (false)
            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Q/S</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>

            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Sp. Arr 1</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>

            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Fact.</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>

            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Sp. Arr 2</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>

            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Sp. Arr 3</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>

            <tr>
              <td class="text-left">
                <table>
                  <tr>
                    <td style="width: 100px">Total</td>
                    <td class="text-right">: </td>
                  </tr>
                </table>
              </td>
              <td>
                <span class="text-right">{{ strval(number_format(0, 2, '.', ',')) }}</span>
              </td>
              <td></td>
            </tr>
            @endif

          </table>
        </td>

        <td class="borderbot bordertop px-2">
          <table class="w-100 text-left">
            <tr>
              <td><b>RETRO'S SHARE ON THE LOSS</b></td>
              <td><b>RECOVERY CLAIM / NET CLAIM</b></td>
            </tr>
            @if (false)
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">18,272,100.00</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">6,229,824.41</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">7,217,479.50</td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="w-100">
                  <tr>
                    <td class="text-left w-50">IDR</td>
                    <td class="text-right w-50">0.00</td>
                  </tr>
                </table>
              </td>
            </tr>
            @endif
          </table>
        </td>

      </tr>

      <tr>
        <td valign="top" class="borderrig borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>Potential Recovery : </b> {{ @$claim->potential_recovery == "1" ? "Yes" : "No" }}
            </div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->desc_poten_rec }}</div>
        </td>
        <td valign="top" class="borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>Chronology</b></div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->kronologi }}</div>
        </td>
      </tr>

      <tr>
        <td valign="top" class="borderrig borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>Staff Recommendation</b></div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->staff_recomendation }}</div>
        </td>
        <td valign="top" class="borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>Assistan Manager Recommendation</b></div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->ass_man_recomen }}</div>
        </td>
      </tr>

      <tr>
        <td valign="top" class="borderrig borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>Manager Recommendation</b></div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->man_recomen }}</div>
        </td>
        <td valign="top" class="borderbot bordertop px-2" style="height: 100px;">
          <div class="mb-1">
            <div class="text-left"><b>General Manager Recommendation</b></div>
          </div>
          <div style="text-align: left; white-space: pre-wrap;">{{ @$claim->gen_man_recomen }}</div>
        </td>
      </tr>

      <tr>
        <td colspan=2 class="text-left borderbot bordertop px-2">
          <table class="w-100 mb-1">
            @foreach ($options as $opt)
            <tr>
              <td style="width: 30%">{{ $loop->iteration }}. {{ $opt->name }}
              </td>
              <td valign="top" style="width: 2%;"><input type="checkbox"
                  style="height: 10px !important; transform: scale(0.6); margin: 0; padding: 0;"></td>
              <td style="width: 15%; padding: 0; margin: 0;">{{ $opt->yes }}</td>
              <td valign="top" style="width: 2%;"><input type="checkbox"
                  style="height: 10px !important; transform: scale(0.6); margin: 0; padding: 0;"></td>
              <td style="width: 15%; padding: 0; margin: 0;">{{ $opt->no }}</td>
            </tr>
            @endforeach
          </table>
        </td>
      </tr>

      <tr>
        <td class="borderrig borderbot bordertop px-2">
          <div class="mb-1">
            <div><b>EXAMINER</b></div>
          </div>

          <div class="" style="height: 75px;">
          </div>

          <div>
            <div><b>{{ @$claim->userexaminer->name }}</b></div>
            <table class="w-100">
              <tr>
                <td class="text-left">Signature</td>
                <td class="text-left">Date</td>
              </tr>
            </table>
          </div>
        </td>

        <td class="borderbot bordertop px-2">
          <div>
            <div><b>CHECKED ASSISTANT MANAGER</b></div>
          </div>

          <div class="" style="height: 75px;">
          </div>

          <div>
            <div><b>{{ @$claim->userastman->name }}</b></div>
            <table class="w-100">
              <tr>
                <td class="text-left">Signature</td>
                <td class="text-left">Date</td>
              </tr>
            </table>
          </div>
        </td>
      </tr>

      <tr>
        <td class="borderrig borderbot bordertop px-2">
          <div class="mb-1">
            <div><b>RECOMMENDATION / DECISION OF MANAGER</b></div>
            <div><b>AGREED / NOT AGREED</b></div>
          </div>

          <div class="" style="height: 75px;">
          </div>

          <div>
            <div><b>{{ @$claim->userdecman->name }}</b></div>
            <table class="w-100">
              <tr>
                <td class="text-left">Signature</td>
                <td class="text-left">Date</td>
              </tr>
            </table>
          </div>
        </td>

        <td class="borderbot bordertop px-2">
          <div>
            <div><b>RECOMMENDATION / DECISION OF THE GENERAL MANAGER</b></div>
            <div><b>AGREED / NOT AGREED</b></div>
          </div>

          <div class="" style="height: 75px;">
          </div>

          <div>
            <div><b>{{ @$claim->usergenman->name }}</b></div>
            <table class="w-100">
              <tr>
                <td class="text-left">Signature</td>
                <td class="text-left">Date</td>
              </tr>
            </table>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan=2 class="borderbot bordertop">Note : Please use continuation sheet(s) for further comments ( if any)
        </td>
      </tr>

    </table>
  </main>
</body>

</html>