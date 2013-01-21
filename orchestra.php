<?php

Event::listen('orchestra.form: user.account', function ($user, $form)
{
	$form->extend(function ($form)
	{
		$form->fieldset('Timezone', function ($fieldset)
		{
			$fieldset->control('select', 'meta_timezone', function ($control)
			{
				$control->label   = 'Timezone';
				$control->options = Localtime\Model\Timezone::lists();
				$control->value   = function ($row)
				{
					$meta = Orchestra\Memory::make('user');

					return $meta->get("timezone.{$row->id}", Config::get('application.timezone'));
				};
			});
		});
	});
});

Event::listen('orchestra.saved: user.account', function ($user)
{
	$user_id = $user->id;
	$meta    = Orchestra\Memory::make('user');

	$meta->put("timezone.{$user_id}", Input::get('meta_timezone'));
});