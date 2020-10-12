<div class="row">
  <div class="col-md-6">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.3257202625227!2d106.69037385111042!3d10.786345992277074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f2f20ed1c49%3A0x5781806fe59379f4!2zQ8O0bmcgVHkgQ-G7lSBQaOG6p24gTOG6rXAgVHLDrG5oIFplbmQgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1578582210228!5m2!1svi!2s" width="560" height="600" frameborder="0" style="border:0;" allowfullscreen="">
      </iframe>
  </div>
@php
    $error = $errors->messages();
@endphp
  <div class="col-md-6">
    <h4 class="mb5">Gửi tin nhắn cho chúng tôi</h4>
    <p style="line-height: 25px">Bạn chỉ đầy đủ thông tin cá nhân và vấn đề trao đổi với ZendVN vào form bên dưới, sau khi nhận được thông tin này chúng tôi sẽ liên hệ với các bạn trong thời gian sớm nhất.</p>
    <form class="contact_form" id="contact_form" name="contact_form" action="{{route('contact/save')}}" method="POST">
      @csrf
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="exampleInputName">Họ tên</label>
            <input id="form_name" name="name" class="form-control" type="text">
            <span class="text-danger">{{$error['name'][0]??''}}</span>
          </div>
        </div>
        <div class="col-sm-12"><div class="form-group">
          <label for="exampleInputEmail">Email</label>
          <input id="form_email" name="email" class="form-control email" type="email">
        </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="exampleInputPhone">Phone</label>
            <input id="form_phone" name="phone" class="form-control" type="text">
            <span class="text-danger">{{$error['phone'][0]??''}}</span>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="exampleInputEmail1">Lời nhắn</label>
            <textarea id="form_message" name="message" class="form-control" rows="5"></textarea>
          </div>
          <div class="form-group ui_kit_button mb0">
            <button type="submit" class="btn dbxshad btn-md btn-thm circle white" id="btnContact">Gửi ngay</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>