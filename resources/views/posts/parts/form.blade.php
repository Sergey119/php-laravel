<div class="form-group">
    <input type="text" class="form-control" name="title" required value="{{$post->title ?? ''}}">
</div>
<div class="form-group">
    <textarea name="des" rows="3" class="form-control" required>{{$post->des ?? ''}}</textarea>
</div>
<div class="form-group">
    <input type="file" name="image">
</div>
