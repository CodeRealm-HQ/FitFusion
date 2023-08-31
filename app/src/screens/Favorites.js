import React from 'react';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs';
import ColorsApp from '../config/ColorsApp';
import usePreferences from '../hooks/usePreferences';
import WorkoutsFav from './WorkoutsFav';
import DietsFav from './DietsFav';
import { View } from 'react-native-animatable';

const Tab = createMaterialTopTabNavigator();

export default function Favorites(props) {

  const contextState = React.useContext(LanguageContext);
  const language = contextState.language;
  const Strings = Languages[language].texts;
  const {theme} = usePreferences();
  
 return (


  <View style={{flex: 1}}>
    
    <Tab.Navigator 
    tabBarOptions={{
        indicatorStyle: { backgroundColor: ColorsApp.PRIMARY, padding:2 },
        labelStyle: { fontSize: 16, textTransform: 'capitalize', fontWeight:'bold' },
        style: { backgroundColor: theme === "light" ? '#fff' : '#000' },
      }}
    >
      <Tab.Screen name={Strings.ST5} component={WorkoutsFav} />
      <Tab.Screen name={Strings.ST27} component={DietsFav} />
    </Tab.Navigator>


    </View>

      );

}


