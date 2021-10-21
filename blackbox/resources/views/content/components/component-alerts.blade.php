@extends('layouts/contentLayoutMaster')

@section('title', 'Alerts')

@section('content')
<!-- Basic Alerts start -->
<section id="basic-alerts">
  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Default</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Alerts are available for any length of text, as well as an optional dismiss button. Add
            <code>.alert.alert-{color}</code> classes for alert with all theme colors.
          </p>
          <div class="demo-spacing-0">
            <div class="alert alert-primary" role="alert">
              <div class="alert-body"><strong>Good Morning!</strong> Start your day with some alerts.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Alerts end -->

<!-- Alerts with Title start -->
<section id="alerts-with-title">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Title</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Add a title to the alert with the <code>.alert-heading</code></p>
          <div class="demo-spacing-0">
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Lorem ipsum dolor sit amet</h4>
              <div class="alert-body">
                Lorem ipsum dolor sit amet <a href="#" class="alert-link">consectetur</a> adipisicing elit. Ducimus,
                laborum!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Alerts with Title end -->

<!-- Alert Colors start -->
<section id="alert-colors">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Colors</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Alerts are available for any length of text, as well as an optional dismiss button. Add
            <code>.alert.alert-{color}</code> classes for alert with all theme colors.
          </p>
          <div class="demo-spacing-0">
            <div class="alert alert-primary" role="alert">
              <h4 class="alert-heading">Primary</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-secondary" role="alert">
              <h4 class="alert-heading">Secondary</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Success</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">Danger</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Warning</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-info" role="alert">
              <h4 class="alert-heading">Info</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
            <div class="alert alert-dark" role="alert">
              <h4 class="alert-heading">Dark</h4>
              <div class="alert-body">
                Tootsie roll lollipop lollipop icing. Wafer cookie danish macaroon. Liquorice fruitcake apple pie I love
                cupcake cupcake.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Alert Colors End -->

<!--Closable Alerts start -->
<section id="alerts-closable">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Closable Alerts</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Add a dismiss button and the <code>.alert-dismissible</code> class, which adds extra padding to the right of
            the alert and positions the <code>.btn-close</code> button.
          </p>
          <div class="demo-spacing-0">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <div class="alert-body">
                Chupa chups topping bonbon. Jelly-o toffee I love. Sweet I love wafer I love wafer.
              </div>
              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Closable Alerts end -->

<!-- Alert With Icon start -->
<section id="alerts-with-icons">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Icon</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Alert With Icon</p>
          <div class="demo-spacing-0">
            <div class="alert alert-primary" role="alert">
              <div class="alert-body d-flex align-items-center">
                <i data-feather="star" class="me-50"></i>
                <span> Chupa chups topping bonbon. Jelly-o toffee I love. Sweet I love wafer I love wafer.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Alert With Icon end -->

<!-- Example Alert start -->
<section id="alert-example">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Example</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            An example would be to have an input and when a condition is met, show the alert. use class
            <code>.alert-validation</code> for your input and class <code>.alert-validation-msg</code> with your alert.
          </p>
          <form>
            <label for="numbers" class="form-label">Enter Only Numbers</label>
            <input id="numbers" class="form-control w-25 h-25 alert-validation" type="text" placeholder="0123456789" />
          </form>
          <div class="demo-spacing-0">
            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
              <div class="alert-body d-flex align-items-center">
                <i data-feather="info" class="me-50"></i>
                <span>The value is <strong>invalid</strong>. You can only enter numbers.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Example Alert end -->
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
@endsection
