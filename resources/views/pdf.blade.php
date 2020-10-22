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
        h5 {
            text-align: center;
        }
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

<h5>Comprovante de Venda</h5>
<h6>{{$pedido->cod_pedido}}</h6>
<h6>Cliente:{{$pedido->cliente->nome}}</h6>

<table class="table">

    <thead style="background-color:black; color: #ffed4a" class="table table-striped table-sm table-bordered table-dark">
    <tr >
        <th style=" width:5%" scoped="col" >item</th>
        <th style=" width:10%" scoped="col">código</th>
        <th style=" width:45%" scoped="col">produto</th>
        <th style=" width:5%" scoped="col"> qtd.</th>
        <th style=" width:15%" scoped="col">valor</th>
        <th style=" width:20%" scoped="col">total</th>

    </tr>
    </thead>

    <tbody class="table table-striped table-sm table-bordered">
    @foreach ($pedido->items as $item)
        <tr >
            <td style=" width:5%">1</td>
            <td style=" width:10%">{{$item->cod_produto}}</td>
            <td style=" width:45%">{{$item->nome}}</td>
            <td style=" width:5%">{{$item->quantidade}}</td>
            <td style=" width:15%">R$ {{number_format($item->valor_vendido, 2, ',', '.')}}</td>
            <td style=" width:20%">R$ {{number_format($item->quantidade*$item->valor_vendido, 2, ',', '.')}}</td>
        </tr>
    @endforeach



    </tbody>

</table>
</body>
</html>