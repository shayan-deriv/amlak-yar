<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

  'accepted' => 'گزینه :attribute باید تایید شود',
  'active_url' => 'گزینه :attribute یک آدرس سایت معتبر نیست',
  'after' => 'گزینه :attribute باید تاریخی بعد از :date باشد',
  'after_or_equal' => 'گزینه :attribute باید تاریخی مساوی یا بعد از :date باشد',
  'alpha' => 'گزینه :attribute باید تنها شامل حروف باشد',
  'alpha_dash' => 'گزینه :attribute باید تنها شامل حروف، اعداد، خط تیره و زیر خط باشد',
  'alpha_num' => 'گزینه :attribute باید تنها شامل حروف و اعداد باشد',
  'array' => 'گزینه :attribute باید آرایه باشد',
  'before' => 'گزینه :attribute باید تاریخی قبل از :date باشد',
  'before_or_equal' => 'گزینه :attribute باید تاریخی مساوی یا قبل از :date باشد',
  'between' => [
    'numeric' => 'گزینه :attribute باید بین :min و :max باشد',
    'file' => 'گزینه :attribute باید بین :min و :max کیلوبایت باشد',
    'string' => 'گزینه :attribute باید بین :min و :max کاراکتر باشد',
    'array' => 'گزینه :attribute باید بین :min و :max آیتم باشد',
  ],
  'boolean' => 'گزینه :attribute تنها می تواند صحیح یا غلط باشد',
  'confirmed' => 'تایید مجدد گزینه :attribute صحیح نمی باشد',
  'date' => 'گزینه :attribute یک تاریخ صحیح نمی باشد',
  'date_equals' => 'گزینه :attribute باید تاریخی مساوی با :date باشد',
  'date_format' => 'گزینه :attribute با فرمت :format همخوانی ندارد',
  'different' => 'گزینه :attribute و :other باید متفاوت باشند',
  'digits' => 'گزینه :attribute باید :digits عدد باشد',
  'digits_between' => 'گزینه :attribute باید بین :min و :max عدد باشد',
  'dimensions' => 'ابعاد تصویر گزینه :attribute مجاز نمی باشد',
  'distinct' => 'گزینه :attribute دارای افزونگی داده می باشد',
  'email' => 'گزینه :attribute باید یک آدرس ایمیل صحیح باشد',
  'ends_with' => 'گزینه :attribute باید با یکی از این مقادیر پایان یابد، :values',
  'exists' => 'گزینه انتخاب شده :attribute صحیح نمی باشد',
  'file' => 'گزینه :attribute باید یک فایل باشد',
  'filled' => 'گزینه :attribute نمی تواند خالی باشد',
  'gt' => [
    'numeric' => 'گزینه :attribute باید بزرگتر از :value باشد',
    'file' => 'گزینه :attribute باید بزرگتر از :value کیلوبایت باشد',
    'string' => 'گزینه :attribute باید بزرگتر از :value کاراکتر باشد',
    'array' => 'گزینه :attribute باید بیشتر از :value آیتم باشد',
  ],
  'gte' => [
    'numeric' => 'گزینه :attribute باید بزرگتر یا مساوی :value باشد',
    'file' => 'گزینه :attribute باید بزرگتر یا مساوی :value کیلوبایت باشد',
    'string' => 'گزینه :attribute باید بزرگتر یا مساوی :value کاراکتر باشد',
    'array' => 'گزینه :attribute باید :value آیتم یا بیشتر داشته باشد',
  ],
  'image' => 'گزینه :attribute باید از نوع تصویر باشد',
  'in' => 'گزینه انتخابی :attribute صحیح نمی باشد',
  'in_array' => 'گزینه :attribute در :other وجود ندارد',
  'integer' => 'گزینه :attribute باید از نوع عددی باشد',
  'ip' => 'گزینه :attribute باید آی پی آدرس باشد',
  'ipv4' => 'گزینه :attribute باید آی پی آدرس ورژن 4 باشد',
  'ipv6' => 'گزینه :attribute باید آی پی آدرس ورژن 6 باشد',
  'json' => 'گزینه :attribute باید از نوع رشته جیسون باشد',
  'lt' => [
    'numeric' => 'گزینه :attribute باید کمتر از :value باشد',
    'file' => 'گزینه :attribute باید کمتر از :value کیلوبایت باشد',
    'string' => 'گزینه :attribute باید کمتر از :value کاراکتر باشد',
    'array' => 'گزینه :attribute باید کمتر از :value آیتم داشته باشد',
  ],
  'lte' => [
    'numeric' => 'گزینه :attribute باید مساوی یا کمتر از :value باشد',
    'file' => 'گزینه :attribute باید مساوی یا کمتر از :value کیلوبایت باشد',
    'string' => 'گزینه :attribute باید مساوی یا کمتر از :value کاراکتر باشد',
    'array' => 'گزینه :attribute نباید کمتر از :value آیتم داشته باشد',
  ],
  'max' => [
    'numeric' => 'گزینه :attribute نباید بزرگتر از :max باشد',
    'file' => 'گزینه :attribute نباید بزرگتر از :max کیلوبایت باشد',
    'string' => 'گزینه :attribute نباید بزرگتر از :max کاراکتر باشد',
    'array' => 'گزینه :attribute نباید بیشتر از :max آیتم داشته باشد',
  ],
  'mimes' => 'گزینه :attribute باید دارای یکی از این فرمت ها باشد: :values',
  'mimetypes' => 'گزینه :attribute باید دارای یکی از این فرمت ها باشد: :values',
  'min' => [
    'numeric' => 'گزینه :attribute باید حداقل :min باشد',
    'file' => 'گزینه :attribute باید حداقل :min کیلوبایت باشد',
    'string' => 'گزینه :attribute باید حداقل :min کاراکتر باشد',
    'array' => 'گزینه :attribute باید حداقل :min آیتم داشته باشد',
  ],
  'not_in' => 'گزینه انتخابی :attribute صحیح نمی باشد',
  'not_regex' => 'فرمت گزینه :attribute صحیح نمی باشد',
  'numeric' => 'گزینه :attribute باید از نوع عددی باشد',
  'present' => 'گزینه :attribute باید از نوع درصد باشد',
  'regex' => 'فرمت گزینه :attribute صحیح نمی باشد',
  'required' => ' :attribute الزامی است',
  'required_if' => ' :attribute زمانی که :other دارای مقدار :value است الزامی می باشد',
  'required_unless' => ' :attribute الزامی می باشد مگر :other دارای مقدار :values باشد',
  'required_with' => ' :attribute زمانی که مقدار :values درصد است الزامی است',
  'required_with_all' => ' :attribute زمانی که مقادیر :values درصد است الزامی می باشد',
  'required_without' => ' :attribute زمانی که مقدار :values درصد نیست الزامی است',
  'required_without_all' => ' :attribute زمانی که هیچ کدام از مقادیر :values درصد نیست الزامی است',
  'same' => 'گزینه های :attribute و :other باید یکی باشند',
  'size' => [
    'numeric' => 'گزینه :attribute باید :size باشد',
    'file' => 'گزینه :attribute باید :size کیلوبایت باشد',
    'string' => 'گزینه :attribute باید :size  کاراکتر باشد',
    'array' => 'گزینه :attribute باید شامل :size آیتم باشد',
  ],
  'starts_with' => 'گزینه :attribute باید با یکی از این مقادیر شروع شود، :values',
  'string' => 'گزینه :attribute باید تنها شامل حروف باشد',
  'timezone' => 'گزینه :attribute باید از نوع منطقه زمانی صحیح باشد',
  'unique' => 'این :attribute از قبل ثبت شده است',
  'uploaded' => 'آپلود گزینه :attribute شکست خورد',
  'url' => 'فرمت :attribute اشتباه است',
  'uuid' => 'گزینه :attribute باید یک UUID صحیح باشد',

  /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'custom-message',
    ],
  ],

  /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

  'attributes' => [
    'otp' => 'توکن',
    'phone' => 'شماره موبایل',
    'firebase_token' => 'توکن فایربیس',
    'first_name' => 'نام',
    'last_name' => 'نام خانوادگی',
    'city_id' => 'شهر',
    'state_id' => 'استان',
    'area_id' => 'محله',
    'complex_id' => 'مجتمع مسکونی',
    'email' => 'آدرس ایمیل',
    'birth_date' => 'تاریخ تولد',
    'gender' => 'جنسیت',
    'accept_terms_and_policy' => 'مرام نامه و سیاست محرمانگی',
    'date' => 'تاریخ',
    'location' => 'آدرس مکان',
    'description' => 'توضیحات',
    'contact_id' => 'مخاطب',
    'type' => 'نوع',
    'body' => 'توضیحات',
    'list' => 'لیست',
    'is_prospect' => 'پراسپکت',
    'is_customer' => 'مشتری',
    'installed_application' => 'اپلیکیشن را نصب کرده',
    'content_id' => 'محتوی',
    'feedback' => 'بازخورد',
    'title' => 'عنوان',
    'permissions' => 'سطوح دسترسی',
    'thumbnail' => 'تصویر بند انگشتی',
    'attachment_type' => 'نوع ضمیمه',
    'external_link' => 'لینک خارجی',
    'file' => 'فایل',
    'direct_permissions.*' => 'دسترسی‌های مستقیم',
    'question' => 'سوالات',
    'start' => 'شروع',
    'finish' => 'پایان',
    'status' => 'پایان',
    'user_id' => 'کاربر',
    'city' => 'شهر',
    'form_id' => 'فرم',
    'member_dpt' => 'عمق دسترسی',
    'level' => 'سطح',
    'member_id' => 'عضو',
    'ids' => 'شناسه‌ها',
    'order_id' => 'سفارش',
    'sub_orders' => 'اقلام سفارش',
    'target' => 'هدف',
    'members' => 'اعضا',
    'code' => 'کد',
    'image' => 'تصویر',
    'avatar' => 'تصویر پروفایل',
    'plan_id' => 'پلن',
    'task_id' => 'کار',
    'end' => 'پایان',
    'landlord_first_name' => 'نام مالک',
    'landlord_last_name' => 'نام خانوادگی مالک',
    'type' => 'نوع ملک',
    'water' => 'آب',
    'electricity' => 'برق',
    'gas' => 'گاز',
  ],
];