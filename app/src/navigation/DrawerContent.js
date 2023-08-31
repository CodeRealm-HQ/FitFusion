import React from 'react';
import { View, Image, TouchableOpacity, I18nManager } from 'react-native';
import { DrawerContentScrollView } from "@react-navigation/drawer";
import { List } from "react-native-paper";
import Styles from '../config/Styles';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import usePreferences from '../hooks/usePreferences';

export default function DrawerContent(props){

    const contextState = React.useContext(LanguageContext);
    const language = contextState.language;
    const Strings = Languages[language].texts;
    const {theme} = usePreferences();

	const {navigation} = props;
	const rightIcon = I18nManager.isRTL ? "chevron-left" : "chevron-right";

	const onChangeScreen = (screen) => {
		navigation.navigate(screen);
	};

	return (

		<DrawerContentScrollView>

		<TouchableOpacity onPress={() => onChangeScreen("home")} activeOpacity={0.8}>
		<View style={Styles.DrawerHeader}>
			<Image source={theme === "dark" ? require('../../assets/white.png') : require('../../assets/black.png')} resizeMode={"contain"} style={Styles.DrawerImage} />
		</View>
		</TouchableOpacity>

		<View style={{flex: 1}}>

		<TouchableOpacity onPress={() => onChangeScreen("workouts")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST5}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="calendar-month-outline" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("exercises")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST21}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="dumbbell" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("diets")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST27}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="fruit-watermelon" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("store")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST45}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="cart-outline" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("blog")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST29}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="rss" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("profile")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST6}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="account-outline" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("favorites")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST4}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="heart-outline" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>

		<TouchableOpacity onPress={() => onChangeScreen("settings")} activeOpacity={0.8}>
		<List.Item
		titleStyle={Styles.DrawerTitleMenu}
		style={Styles.DrawerMenuItem}
		title={Strings.ST108}
		left={props => <Icon {...props} style={Styles.DrawerIconMenu} name="cog-outline" />}
		right={props => <Icon {...props} style={Styles.DrawerIconRightMenu} name={rightIcon} />}
		/>
		</TouchableOpacity>


		</View>

		</DrawerContentScrollView>

		)
}