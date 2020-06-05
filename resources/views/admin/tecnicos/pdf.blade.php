<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Nome</b></td>
        <td><b>Series</b></td>
        <td><b>Lead Actor</b></td>     
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          {{$tecnico->tecnico->name}}
        </td>
        <td>
          {{$tecnico->analista->name}}
        </td>
        <td>
          {{$tecnico->present()->date_br}}
        </td>
      </tr>
      </tbody>
    </table>
  </body>
</html>