<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>家計簿アプリ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <header>
        <h1>収支編集</h1>
    </header>

    <div class="edit-page">
        <div class="form-balance edit-balance">
            
            <form action="{{route('homebudget.update')}}" method="POST">
                @csrf
                @method('put')

                <input type="hidden"  id="id" name="id" value="{{$homebudget->id}}">
                <label for="date">日付:</label>
                <input type="date" id="date" name="date" value="{{$homebudget->date}}"><br>
                @if($errors->has('date')) <span class="error">{{$errors->first('date')}}</span> @endif
                
                <label for="category">カテゴリ:</label>
                <select name="category" id="category">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == $homebudget->category_id ? 'selected' : ''}}>
                        {{$category->name}}
                    </option>
                    @endforeach
                </select><br>

                <label for="price">金額:</label>
                <input type="text" id="price" name="price"  value="{{$homebudget->price}}">
                @if($errors->has('price')) <span class="error">{{$errors->first('price')}}</span> @endif

                <div class="button-container">
                    <button type="submit" class="edit-button">更新</button>
                    <input type="button" class="back-button" value="戻る" onclick="window.location.href='{{ url('/') }}'">
                </div>
            </form>
        </div>
    </div>
</body>
</html>