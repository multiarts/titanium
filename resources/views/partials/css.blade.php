<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" async />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
<style>
  .custom-control.teleport-switch {
    --color: #28a745;
    padding-left: 0;
  }

  .custom-control.teleport-switch .teleport-switch-control-input {
    display: none;
  }

  .custom-control.teleport-switch .teleport-switch-control-input:checked~.teleport-switch-control-indicator {
    border-color: var(--color);
  }

  .custom-control.teleport-switch .teleport-switch-control-input:checked~.teleport-switch-control-indicator::after {
    left: -14px;
  }

  .custom-control.teleport-switch .teleport-switch-control-input:checked~.teleport-switch-control-indicator::before {
    right: 2px;
    background-color: var(--color);
  }

  .custom-control.teleport-switch .teleport-switch-control-indicator {
    display: inline-block;
    position: relative;
    margin: 0 10px;
    top: 4px;
    width: 45px;
    height: 25px;
    background: #fff;
    border-radius: 16px;
    transition: 0.3s;
    border: 1px solid #ccc;
    overflow: hidden;
    box-shadow: 2px 4px 6px 0px rgba(40, 167, 69, 0.32);
  }

  .custom-control.teleport-switch .teleport-switch-control-indicator::after {
    content: '';
    display: block;
    position: absolute;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    transition: 0.3s;
    top: 18%;
    left: 4px;
    background: #ccc;
  }

  .custom-control.teleport-switch .teleport-switch-control-indicator::before {
    content: '';
    display: block;
    position: absolute;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    transition: 0.3s;
    top: 18%;
    right: -21px;
    background: #ccc;
  }
</style>