<form action="{{route('calcPost')}}" method="POST">
    @csrf
    <div>
        <div><label for="">Оклад</label></div>
        <div><input type="text" name="salary"></div>
    </div>
    <div>
        <div><label for="">Норма дней</label></div>
        <div><input type="text" name="defaultdays" value="22"></div>
    </div>
    <div>
        <div><label for="">Отработанное количество дней</label></div>
        <div><input type="text" name="workdays"></div>
    </div>
    <div>
        <label for="">Имеется ли налоговый вычет 1 МЗП</label>
        <input type="checkbox" name="hasvichet">
    </div>
    <div>
        <div><label for="">Календарный год</label></div>
        <div><input type="number" name="year"></div>
    </div>
    <div>
        <div><label for="">Календарный месяц</label></div>
        <div><input type="number" name="month"></div>
    </div>
    <div>
        <label for="">Пенсионер</label>
        <input type="checkbox" name="isretired">
    </div>
    <div>
        <div><label for="">Инвалид</label></div>
        <select name="invalid" id="">
            <option value="">Нет</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>
    <button type="submit">Ввод</button>
</form>
