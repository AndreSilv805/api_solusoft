<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table,th {
            border: 1px solid black;
        }
        th {
            border: 1px solid black;
            color: white;
        }
        <!--comentário-->
        table,td {
            border: 1px solid black;

        }

    </style>
</head>
<body>

<h2>Comprovante de Venda</h2>
<p>Codigo pedido: {{$pedido->id}}<br>
{{$pedido->created_at->format('d/m/Y')}}</p>

@if ($pedido->cliente != null)
    <h4>Dados do Cliente</h4>
    <p>{{$pedido->cliente->nome}}<br>
    cpf:{{$pedido->cliente->cpf}}</p>
@endif


<table style="width:100%" class="table">

    <thead style="background-color:black; color: #ffed4a; text-align:center" class="table table-striped table-sm table-bordered table-dark">
    <tr >
        <th style=" width:5%" scoped="col" >item</th>
        <th style=" width:10%" scoped="col">código</th>
        <th style=" width:45%" scoped="col">produto</th>
        <th style=" width:5%" scoped="col"> qtd.</th>
        <th style=" width:15%" scoped="col">valor</th>
        <th style=" width:20%" scoped="col">total</th>

    </tr>
    </thead>

    <tbody  style="text-align:center" class="table table-striped table-sm table-bordered">
    @foreach ($pedido->items as $item )
        <tr >
            <td style=" width:5%">{{$numItem++}}</td>
            <td style=" width:10%">{{$item->cod_produto}}</td>
            <td style="text-align:left; width:45%">{{$item->nome}}</td>
            <td style=" width:5%">{{$item->quantidade}}</td>
            <td style="text-align:right; width:15%">{{number_format($item->valor_vendido, 2, ',', '.')}}</td>
            <td style="text-align:right; width:20%">{{number_format($item->quantidade*$item->valor_vendido, 2, ',', '.')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

        <p style="text-align:right">Total {{number_format($total, 2, ',', '.')}}</p>
        <p>Observação do pedido: {{$pedido->obeservacao}}</p>
</body>
</html>